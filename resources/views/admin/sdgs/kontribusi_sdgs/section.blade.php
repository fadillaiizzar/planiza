<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">

    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'defaultFilterText' => 'Semua Status',
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

                            <td class="p-4">
                                {{ Str::limit($item->user?->name ?? '-', 9) }}
                            </td>

                            <td class="p-4 text-slate-navy hidden md:table-cell">
                                {{ trim(($item->user?->siswa?->kelas?->nama_kelas ?? '') . ' ' . ($item->user?->siswa?->jurusan?->nama_jurusan ?? '')) ?: '' }}
                            </td>

                            <td class="p-4">{{ Str::limit($item->judul_kegiatan, 16) }}</td>

                            <td class="p-4">
                                {{ Str::limit(($item->kategoriSdgs?->nomor_kategori ?? '') . ' - ' . ($item->kategoriSdgs?->nama_kategori ?? '-'), 24) }}
                            </td>

                            <td class="p-4">{{ $item->tanggal_pelaksanaan }}</td>

                            <td class="p-4 capitalize relative">
                                <button onclick="toggleStatusDropdown({{ $item->id }})" class="p-2 rounded-lg hover:bg-slate-100 focus:outline-none transition-all">
                                    <span class="px-3 py-1 rounded-full text-white
                                        @if($item->status === 'approved') bg-green-500
                                        @elseif($item->status === 'rejected') bg-red-500
                                        @else bg-yellow-500 @endif">
                                        {{ $item->status }}
                                    </span>
                                </button>

                                @include('admin.sdgs.kontribusi_sdgs.status-dropdown')
                            </td>

                            <td class="p-4 relative overflow-visible">
                                <button onclick="toggleDropdown({{ $item->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $item->id }}" class="hidden absolute right-12 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">
                                    <a href="{{ route('admin.sdgs.kontribusi-sdgs.show', $item->id) }}"
                                        class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                        <i class="fas fa-eye w-5 h-5"></i>
                                        <span>Detail</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <form action="{{ route('admin.sdgs.kontribusi-sdgs.destroy', $item->id) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="showDeleteModal({{ $item->id }}, '{{ addslashes($item->judul_kegiatan) }}', '{{ route('admin.sdgs.kontribusi-sdgs.destroy', $item->id) }}')"
                                            class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base">
                                            <i class="fas fa-trash-alt w-5 h-5"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state
                            icon="fas fa-hands-helping"
                            message="Belum ada kontribusi SDGs"
                        />
                    @endforelse

                    <x-no-data-row />
                </tbody>
            </table>
        </div>
    </section>
</div>

@include('admin.sdgs.kontribusi_sdgs.delete')

<script>
    function showDeleteModal(id, name, action) {
        document.getElementById('deleteKontribusiModal').classList.remove('hidden');
        document.getElementById('deleteNamaKontribusi').innerText = name;
        document.getElementById('deleteKontribusiForm').action = action;
        const form = document.getElementById('deleteForm');
        form.action = action;
    }

    function closeDeleteModal() {
        document.getElementById('deleteKontribusiModal').classList.add('hidden');
    }
</script>
