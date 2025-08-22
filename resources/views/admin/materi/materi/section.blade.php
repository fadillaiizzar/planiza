<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'userCount' => $userCount,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Statistik -->
    <section class="bg-off-white rounded-2xl shadow-lg p-6">
        <x-h3>{{ $statistikTitle }}</x-h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @include('components.admin.materi.materi-card', [
                'icon' => 'fas fa-user-graduate',
                'label' => $labelKelas,
                'items' => $materiPerKelas ?? []
            ])

            @include('components.admin.materi.materi-card', [
                'icon' => 'fas fa-school',
                'label' => $labelJurusan,
                'items' => $materiPerJurusan ?? []
            ])

            @include('components.admin.materi.materi-card', [
                'icon' => 'fas fa-folder-open',
                'label' => $labelRencana,
                'items' => $materiPerRencana ?? []
            ])
        </div>
    </section>

    <!-- Daftar Materi -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <x-h3>{{ $tableTitle }}</x-h3>
        <div class="overflow-x-auto scrollbar-none">
            <table class="w-full text-left text-sm table-auto">
                <thead class="bg-off-white border-b border-border-gray">
                    <tr>
                        @foreach($tableHeaders as $header)
                            <th class="p-4 font-semibold text-slate-navy">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors materi-row"
                            data-nama="{{ strtolower($item->nama_materi) }}"
                            data-topik="{{ strtolower($item->topikMateri->judul_topik ?? '') }}">
                            <td class="p-4">{{ $item->id }}</td>
                            <td class="p-4">
                                <span title="{{ $item->nama_materi }}">
                                    {{ \Illuminate\Support\Str::limit($item->nama_materi, 10) }}
                                </span>
                            </td>
                            <td class="p-4">
                                <span title="{{ $item->topikMateri->judul_topik ?? '-' }}">
                                    {{ \Illuminate\Support\Str::limit($item->topikMateri->judul_topik ?? '-', 10) }}
                                </span>
                            </td>
                            <td class="p-4">
                                <span title="{{ $item->deskripsi_materi }}">
                                    {{ \Illuminate\Support\Str::limit($item->deskripsi_materi, 15) }}
                                </span>
                            </td>
                            <td class="p-4">{{ $item->tipe_file }}</td>
                            <td class="p-4">
                                <span title="{{ implode(', ', json_decode($item->file_materi, true) ?? []) }}">
                                    {{ \Illuminate\Support\Str::limit(
                                        implode(', ', array_map(fn($f) => basename($f), json_decode($item->file_materi, true) ?? [])),
                                        10
                                    ) }}
                                </span>
                            </td>
                            <td class="p-4 relative overflow-visible">
                                <button onclick="toggleDropdown({{ $item->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $item->id }}"
                                    class="hidden absolute right-10 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">
                                    <a href="{{ route('admin.materi.show', $item->id) }}"
                                        class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                        <i class="fas fa-eye w-5 h-5"></i>
                                        <span>Detail</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <button onclick="showEditMateri({{ $item->id }})"
                                        class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                        <span>Edit</span>
                                    </button>
                                    <div class="border-t border-border-gray"></div>
                                    <button type="button"
                                        onclick="showDeleteModal({{ $item->id }}, '{{ addslashes($item->nama_materi) }}', '{{ route('admin.materi.destroy', $item->id) }}')"
                                        class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base border-none bg-transparent cursor-pointer">
                                        <i class="fas fa-trash-alt w-5 h-5"></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state
                            colspan="7"
                            icon="fas fa-book-open"
                            message="Belum ada materi. Tambahkan data"
                            button="true"
                            buttonAction="openModal()"
                            buttonText="+ Tambah Materi"
                        />
                    @endforelse

                    <x-no-data-row />
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Modal Konfirmasi Delete Materi -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-2xl border border-[#CBD5E1] relative overflow-hidden">
        <!-- Decorative header -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-red-600"></div>

        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-[#1E293B] mb-2">Hapus Materi</h3>
            <p class="text-[#64748B] mb-6 leading-relaxed text-sm sm:text-base">
                Apakah Anda yakin ingin menghapus materi bernama
                <span id="deleteUserName"></span> ?
                <br>
                <span class="text-sm text-red-500 mt-2 block">Tindakan ini tidak dapat dibatalkan</span>
            </p>

            <form id="deleteForm" method="POST" class="flex flex-row justify-center gap-5">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()"
                        class="hover:underline text-[#64748B] transition-all duration-200 font-medium w-full sm:w-auto">
                    Batal
                </button>
                <button type="submit"
                        class="px-6 py-2 rounded-full bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg w-full sm:w-auto">
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

    function showDeleteModal(id, name, action) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteUserName').textContent = name;
        const form = document.getElementById('deleteForm');
        form.action = action;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    window.addEventListener('click', function(e) {
        const modal = document.getElementById('deleteModal');
        if (!modal.classList.contains('hidden') && e.target === modal) {
            closeDeleteModal();
        }
    });

    // Klik di luar dropdown tutup dropdown
    document.addEventListener('click', function (e) {
        if (!e.target.closest('[id^="dropdown-"]') && !e.target.closest('button')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
        }
    });

    function showEditMateri(id) {
        fetch(`/admin/materi/${id}/edit`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('modalContentEditMateri').innerHTML = html;
                openModalEditMateri();
        });
    }

    function openModalEditMateri() {
        const modal = document.getElementById('modalEditMateri');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeModalEditMateri() {
        const modal = document.getElementById('modalEditMateri');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }
</script>
