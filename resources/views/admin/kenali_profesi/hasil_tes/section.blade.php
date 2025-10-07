<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => null,
        'userCount' => $userCount,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => 'Cari berdasarkan nama tes',
        'defaultFilterText' => 'Semua Tes',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Daftar Hasil Tes -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-navy mb-4">Daftar Hasil Tes</h3>

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
                    @forelse ($items  as $i => $tes)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors">
                            <td class="p-4">{{ $i + 1 }}</td>
                            <td class="p-4 font-medium text-slate-700">{{ Str::limit($tes->nama_tes, 65) }}</td>
                            <td class="p-4">{{ $tes->jumlah_user }}</td>
                            <td class="p-4">{{ $tes->jumlah_pengerjaan }}</td>
                            <td class="p-4">{{ optional($tes->kenaliProfesis->first()?->updated_at)->format('d M H:i') ?? '-' }}</td>
                            <td class="p-4">
                                <a href="{{ route('admin.kenali-profesi.hasil-tes.users', $tes->id) }}"
                                    class="px-4 py-2 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm shadow hover:shadow-md transition">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state
                            icon="fas fa-clipboard-list"
                            message="Belum ada hasil tes"
                        />
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
