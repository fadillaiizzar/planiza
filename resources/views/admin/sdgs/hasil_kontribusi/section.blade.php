<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">

    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'stats' => $stats,
        'searchPlaceholder' => 'Cari siswa...',
        'itemCount' => count($items),
    ])

    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-navy mb-4">Hasil Rekomendasi</h3>

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
                        <tr class="border-b hover:bg-slate-50">
                            <td class="p-3">{{ $index + 1 }}</td>

                            <td class="p-3">{{ $item->user->name }}</td>

                            <td class="p-3">{{ $item->kelas }}</td>

                            <td class="p-3">{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') : '-' }}</td>

                            <td class="p-3">
                                <a href="{{ route('admin.sdgs.hasil-kontribusi.show', $item->user_id) }}"
                                class="px-3 py-2 bg-blue-100 text-blue-800 rounded-lg">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state icon="fas fa-briefcase" message="Belum ada rekomendasi profesi." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
