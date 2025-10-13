<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'userCount' => $userCount,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'defaultFilterText' => 'Semua Hobi',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Daftar Hobi -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-navy mb-4">Daftar Hobi</h3>

        <div class="overflow-x-auto scrollbar-none">
            <table class="w-full text-left text-sm table-auto">
                <thead class="bg-off-white border-b border-border-gray">
                    <tr>
                        <th class="p-4 font-semibold text-slate-navy w-[60px]">ID</th>
                        <th class="p-4 font-semibold text-slate-navy w-[220px]">Nama Hobi</th>
                        <th class="p-4 font-semibold text-slate-navy w-[120px]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors hobi-row"
                        data-nama="{{ strtolower($item->nama_hobi) }}">
                            <td class="p-4 w-[5%]">{{ $item->id }}</td>
                            <td class="p-4 w-[40%] font-medium text-slate-700">{{ Str::limit($item->nama_hobi, 65) }}</td>
                            <td class="p-4 w-[10%] relative overflow-visible">
                                <button onclick="toggleDropdown({{ $item->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $item->id }}"
                                    class="hidden absolute right-16 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[160px]">
                                    <a href="{{ route('admin.kenali-jurusan.hobi.show', $item->id) }}"
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
                                        onclick="showDeleteModal({{ $item->id }}, '{{ addslashes($item->nama_hobi) }}', '{{ route('admin.kenali-jurusan.hobi.destroy', $item->id) }}')"
                                        class="px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base w-full text-left">
                                        <i class="fas fa-trash-alt w-5 h-5"></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state
                            icon="fas fa-heart"
                            message="Belum ada hobi. Tambahkan data"
                            button="true"
                            buttonAction="openModal()"
                            buttonText="+ Tambah Hobi"
                        />
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

@include('admin.kenali_jurusan.hobi.delete')

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

    window.addEventListener('click', function(e) {
        const modal = document.getElementById('deleteModal');
        if (!modal.classList.contains('hidden') && e.target === modal) {
            closeDeleteModal();
        }
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('[id^="dropdown-"]') && !e.target.closest('button')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
        }
    });

    function showEdit(id) {
        fetch(`/admin/kenali-jurusan/hobi/${id}/edit`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('modalContentEdit').innerHTML = html;
                openModalEdit();
        });
    }

    function openModalEdit() {
        const modal = document.getElementById('modalEdit');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeModalEdit() {
        const modal = document.getElementById('modalEdit');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }
</script>
