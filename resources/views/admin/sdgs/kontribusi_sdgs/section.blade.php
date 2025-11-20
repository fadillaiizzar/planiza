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
                                {{ $item->user?->name ?? '-' }}
                            </td>

                            <td class="p-4 text-slate-navy hidden md:table-cell">
                                {{ $item->user?->siswa?->kelas?->nama_kelas ?? '-' }}
                            </td>

                            <td class="p-4">{{ $item->judul_kegiatan }}</td>

                            <td class="p-4">
                                {{ $item->kategoriSdgs?->nama_kategori ?? '-' }}
                            </td>

                            <td class="p-4">{{ $item->tanggal_pelaksanaan }}</td>

                            <td class="p-4 capitalize relative">

                                <!-- Badge Status -->
                                <span class="px-3 py-1 rounded-full text-white
                                    @if($item->status === 'approved') bg-green-500
                                    @elseif($item->status === 'rejected') bg-red-500
                                    @else bg-yellow-500 @endif">
                                    {{ $item->status }}
                                </span>

                                <!-- Tombol Aksi -->
                                <button onclick="toggleStatusDropdown({{ $item->id }})"
                                    class="ml-2 p-2 rounded-lg hover:bg-slate-100 focus:outline-none transition-all">
                                    <i class="fas fa-cog text-slate-600"></i>
                                </button>

                                <!-- Dropdown Status -->
                                <div id="status-dropdown-{{ $item->id }}"
                                    class="hidden absolute left-0 mt-2 bg-white border border-slate-200 rounded-lg shadow-xl z-20 min-w-[160px]">

                                    <!-- Pending -->
                                    <form action="{{ route('admin.sdgs.kontribusi-sdgs.update-status', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="pending">
                                        <button class="w-full text-left px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-yellow-600 transition-colors">
                                            <i class="fas fa-clock w-5 h-5"></i> Pending
                                        </button>
                                    </form>

                                    <div class="border-t border-slate-200"></div>

                                    <!-- Approved -->
                                    <form action="{{ route('admin.sdgs.kontribusi-sdgs.update-status', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button class="w-full text-left px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors">
                                            <i class="fas fa-check-circle w-5 h-5"></i> Approved
                                        </button>
                                    </form>

                                    <div class="border-t border-slate-200"></div>

                                    <!-- Rejected -->
                                    <form action="{{ route('admin.sdgs.kontribusi-sdgs.update-status', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors">
                                            <i class="fas fa-times-circle w-5 h-5"></i> Rejected
                                        </button>
                                    </form>
                                </div>
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
