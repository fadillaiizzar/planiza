<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'userCount' => $userCount,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'defaultFilterText' => 'Semua Kategori',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Daftar Kategori SDGs -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-navy mb-4">{{ $tableTitle }}</h3>

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
                    @forelse ($items as $item)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors kategori-sdgs-row"
                            data-nama="{{ strtolower($item->nama_kategori) }}"
                            data-deskripsi="{{ strtolower($item->deskripsi) }}">

                            <td class="p-4 w-[5%]">{{ $loop->iteration }}</td>
                            <td class="p-4 w-[15%]">{{ $item->nomor_kategori }}</td>
                            <td class="p-4 w-[25%]">{{ Str::limit($item->nama_kategori, 30) }}</td>
                            <td class="p-4 w-[40%]">{{ Str::limit($item->deskripsi, 55) }}</td>
                            <td class="p-4 relative overflow-visible w-[10%]">
                                <button onclick="toggleDropdown({{ $item->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-green-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $item->id }}"
                                    class="hidden absolute right-16 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[160px]">
                                    <a href="{{ route('admin.sdgs.kategori-sdgs.show', $item->id) }}"
                                        class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
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
                                        onclick="showDeleteModal({{ $item->id }}, '{{ addslashes($item->nama_kategori) }}', '{{ route('admin.sdgs.kategori-sdgs.destroy', $item->id) }}')"
                                        class="px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base w-full text-left">
                                        <i class="fas fa-trash-alt w-5 h-5"></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state
                            icon="fas fa-globe"
                            message="Belum ada kategori SDGs. Tambahkan data"
                            button="true"
                            buttonAction="openModal()"
                            buttonText="+ Tambah Kategori SDGs"
                        />
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

@include('admin.sdgs.kategori_sdgs.delete')

<script>
    function toggleDropdown(id) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(drop => {
            drop.classList.toggle('hidden', drop.id !== `dropdown-${id}`);
        });
    }

    function showDeleteModal(id, name, action) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteKategoriNama').textContent = name;
        document.getElementById('deleteForm').action = action;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('[id^="dropdown-"]') && !e.target.closest('button')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
        }
    });
</script>
