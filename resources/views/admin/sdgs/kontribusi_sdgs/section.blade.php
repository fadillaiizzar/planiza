<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">

    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'defaultFilterText' => 'Semua Kelas',
        'itemCount' => count($items),
    ])

    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-navy mb-4">Daftar Kontribusi SDGs</h3>

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
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition">
                            <td class="p-4">{{ $index + 1 }}</td>

                            <td class="p-4 font-medium text-slate-700">
                                {{ Str::limit($item->user?->name ?? '-', 9) }}
                            </td>

                            <td class="p-4 text-slate-navy hidden md:table-cell">
                                {{ $item->user?->siswa?->kelas?->nama_kelas ?? '-' }}
                            </td>

                            <td class="p-4">{{ Str::limit($item->judul_kegiatan, 16) }}</td>

                            <td class="p-4">
                                {{ Str::limit($item->kategoriSdgs?->nama_kategori ?? '-', 24) }}
                            </td>

                            <td class="p-4">{{ $item->tanggal_pelaksanaan }}</td>

                            <td class="p-4 capitalize relative">
                                @include('admin.sdgs.kontribusi_sdgs.status-dropdown')
                            </td>

                            <td class="p-4">
                                <a href="{{ route('admin.sdgs.kontribusi-sdgs.show', $item->id) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm rounded-full text-white bg-gradient-to-r from-blue-500 to-indigo-600">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state icon="fas fa-clipboard-list" message="Belum ada kontribusi SDGs" />
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
