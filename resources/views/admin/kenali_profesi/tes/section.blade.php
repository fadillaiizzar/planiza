<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'userCount' => $userCount,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'defaultFilterText' => 'Semua Tes',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Daftar Tes -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-navy mb-4">Daftar Tes</h3>

        <div class="overflow-x-auto scrollbar-none">
            <table class="w-full text-left text-sm table-auto">
                <thead class="bg-off-white border-b border-border-gray">
                    <tr>
                        <th class="p-4 font-semibold text-slate-navy w-[60px]">ID</th>
                        <th class="p-4 font-semibold text-slate-navy">Nama Tes</th>
                        <th class="p-4 font-semibold text-slate-navy w-[120px]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors tes-row"
                            data-nama="{{ strtolower($item->nama_tes) }}"
                        >
                            <td class="p-4">{{ $item->id }}</td>
                            <td class="p-4 font-medium text-slate-700">{{ Str::limit($item->nama_tes, 65) }}</td>
                            <td class="p-4 relative overflow-visible">
                                <button onclick="toggleDropdown({{ $item->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $item->id }}" class="hidden absolute right-16 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[160px]">
                                    <a href="{{ route('admin.kenali-profesi.soal-tes.create') }}?tes_id={{ $item->id }}"
                                        class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-yellow-600 transition-colors text-base w-full text-left">
                                        <i class="fas fa-list-ul w-5 h-5"></i>
                                        <span>Soal</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <a href="{{ route('admin.kenali-profesi.tes.show', $item->id) }}"
                                        class="px-5 py-3 hover:bg-blue-50 flex items-center gap-3 text-blue-600 transition-colors text-base w-full text-left">
                                        <i class="fas fa-eye w-5 h-5"></i>
                                        <span>Detail</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <button onclick="showEdit({{ $item->id }})"
                                        class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base w-full text-left">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                        <span>Edit</span>
                                    </button>
                                    <div class="border-t border-border-gray"></div>
                                    <button type="button"
                                        onclick="showDeleteModal({{ $item->id }}, '{{ addslashes($item->nama_tes) }}', '{{ route('admin.kenali-profesi.tes.destroy', $item->id) }}')"
                                        class="px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base w-full text-left">
                                        <i class="fas fa-trash-alt w-5 h-5"></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state
                            icon="fas fa-vial"
                            message="Belum ada tes. Tambahkan data"
                            button="true"
                            buttonAction="openModal()"
                            buttonText="+ Tambah Tes"
                        />
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Modal Konfirmasi Delete Tes -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-2xl border border-[#CBD5E1] relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-red-600"></div>
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1E293B] mb-2">Hapus Tes</h3>
            <p class="text-[#64748B] mb-6 leading-relaxed text-sm sm:text-base">
                Apakah Anda yakin ingin menghapus tes
                <span id="deleteTesNama"></span> ?
                <br>
                <span class="text-sm text-red-500 mt-2 block">Tindakan ini tidak dapat dibatalkan</span>
            </p>
            <form id="deleteForm" method="POST" class="flex flex-row justify-center gap-5">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="hover:underline text-[#64748B]">Batal</button>
                <button type="submit"
                    class="px-6 py-2 rounded-full bg-gradient-to-r from-red-500 to-red-600 text-white shadow-md hover:shadow-lg">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleDropdown(id) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(drop => {
            if (drop.id === `dropdown-${id}`) {
                drop.classList.toggle('hidden');
            } else {
                drop.classList.add('hidden');
            }
        });
    }
</script>
