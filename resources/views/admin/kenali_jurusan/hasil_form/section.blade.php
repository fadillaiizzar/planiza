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
                            <td class="p-4 font-medium text-slate-700">{{ $item->name ?? '-' }}</td>
                            <td class="p-4 text-slate-navy hidden md:table-cell">
                                {{ ($item->siswa?->kelas?->nama_kelas ?? '-') . ' ' . ($item->siswa?->jurusan?->nama_jurusan ?? '-') }}
                            </td>
                            <td class="p-4">{{ $item->form_kuliahs_count ?? 0 }}</td>
                            <td class="p-4">{{ $item->update_terakhir ?? '-' }}</td>
                            <td class="p-4">
                                <a href="{{ route('admin.kenali-jurusan.hasil-form.user-history', $item->id) }}"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full hover:shadow-md transition">
                                    Detail
                                </a>
                            </td>
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
