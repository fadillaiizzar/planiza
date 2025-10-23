<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => null,
        'userCount' => $totalUser ?? 0,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari user...',
        'defaultFilterText' => 'Semua User',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Daftar Hasil Form -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-navy mb-4">{{ $tableTitle ?? 'Daftar Hasil Form' }}</h3>

        <div class="overflow-x-auto scrollbar-none">
            <table class="w-full text-left text-sm table-auto">
                <thead class="bg-off-white border-b border-border-gray">
                    <tr>
                        @foreach ($tableHeaders as $header)
                            <th class="p-4 font-semibold text-slate-navy">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $index => $item)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors">
                            <td class="p-4">{{ $index + 1 }}</td>
                            <td class="p-4 font-medium text-slate-700">{{ $item->nama_user ?? '-' }}</td>
                            <td class="p-4 text-slate-navy hidden md:table-cell">
                                {{ ($item->nama_kelas ?? '-') . ' ' . ($item->nama_jurusan ?? '') }}
                            </td>
                            <td class="p-4">{{ $item->jumlah_pengerjaan ?? 0 }}</td>
                            <td class="p-4">{{ \Carbon\Carbon::parse($item->update_terakhir)->format('d M H:i') ?? '-' }}</td>
                            <td class="p-4">
                                <button class="btn-detail inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full hover:shadow-md transition"
                                        data-user="{{ $item->user_id }}">
                                    Detail
                                </button>
                            </td>

                            <!-- Collapse Detail Row -->
                            <tr id="collapse-{{ $item->user_id }}" class="hidden">
                                <td colspan="6" class="p-4 bg-off-white">
                                    <div id="detail-{{ $item->user_id }}">
                                        <div class="h-4 bg-border-gray rounded w-1/4 mb-4"></div>
                                        <div class="h-32 bg-border-gray rounded"></div>
                                    </div>
                                </td>
                            </tr>
                        </tr>
                    @empty
                        <x-empty-state
                            icon="fas fa-clipboard-list"
                            message="Belum ada hasil form"
                        />
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', async () => {
                const userId = btn.dataset.user;
                const collapse = document.getElementById('collapse-' + userId);
                const detailDiv = document.getElementById('detail-' + userId);

                // Toggle row
                if (!collapse.classList.contains('hidden')) {
                    collapse.classList.add('hidden');
                    return;
                }

                // Show loading
                detailDiv.innerHTML = `
                    <div class="flex items-center justify-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-slate-navy"></div>
                        <span class="ml-3 text-cool-gray">Memuat data...</span>
                    </div>
                `;

                try {
                    const res = await fetch(`/admin/kenali-jurusan/hasil-form/user/${userId}`);
                    const data = await res.json();

                    let html = `
                        <div class="bg-white rounded-xl border border-border-gray p-6">
                            <h6 class="text-base font-bold text-slate-navy mb-4">Detail Pengerjaan ${data.nama}</h6>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead class="bg-off-white">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-navy">Pengerjaan ke</th>
                                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-navy">Tanggal</th>
                                            <th class="px-4 py-3 text-center text-xs font-semibold text-slate-navy">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-border-gray">
                                        ${data.riwayat.map(r => `
                                            <tr class="hover:bg-off-white transition-colors duration-150">
                                                <td class="px-4 py-3 text-slate-navy font-medium">${r.ke}</td>
                                                <td class="px-4 py-3 text-cool-gray">${r.tanggal}</td>
                                                <td class="px-4 py-3 text-center">
                                                    <a href="/admin/kenali-jurusan/hasil-form/${r.id_form}"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-slate-navy rounded-lg hover:bg-opacity-90 transition">
                                                    Lihat Form
                                                    </a>
                                                </td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4 text-sm text-cool-gray">Total <span class="font-semibold text-slate-navy">${data.total}</span> pengerjaan</div>
                        </div>
                    `;

                    detailDiv.innerHTML = html;
                    collapse.classList.remove('hidden');
                } catch (err) {
                    detailDiv.innerHTML = `<div class="text-center text-red-500">Gagal memuat data</div>`;
                    console.error(err);
                }
            });
        });
    </script>
@endpush
