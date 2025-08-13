<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'addUserRoute' => $addUserRoute,
        'userCount' => $userCount,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Statistik -->
    <section class="bg-off-white rounded-2xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-slate-navy mb-6">{{ $statistikTitle }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Item per Kelas -->
            <div class="bg-white rounded-xl border border-border-gray shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
                <h4 class="text-lg font-semibold text-slate-navy mb-4">{{ $iconKelas ?? '📚' }} {{ $labelKelas }}</h4>
                <ul class="space-y-2 text-cool-gray">
                    @foreach(($materiPerKelas ?? []) as $kelas => $count)
                        <li class="flex justify-between items-center border-b border-border-gray pb-1 last:border-none last:pb-0">
                            <span>{{ $kelas }}</span>
                            <strong class="text-slate-navy">{{ $count }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Item per Jurusan -->
            <div class="bg-white rounded-xl border border-border-gray shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
                <h4 class="text-lg font-semibold text-slate-navy mb-4">{{ $iconJurusan ?? '🏫' }} {{ $labelJurusan }}</h4>
                <ul class="space-y-2 text-cool-gray">
                    @foreach(($materiPerJurusan ?? []) as $jurusan => $count)
                        <li class="flex justify-between items-center border-b border-border-gray pb-1 last:border-none last:pb-0">
                            <span>{{ $jurusan }}</span>
                            <strong class="text-slate-navy">{{ $count }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Item per Rencana -->
            <div class="bg-white rounded-xl border border-border-gray shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
                <h4 class="text-lg font-semibold text-slate-navy mb-4">{{ $iconRencana ?? '🗂' }} {{ $labelRencana }}</h4>
                <ul class="space-y-2 text-cool-gray">
                    @foreach(($materiPerRencana ?? []) as $rencana => $count)
                        <li class="flex justify-between items-center border-b border-border-gray pb-1 last:border-none last:pb-0">
                            <span>{{ $rencana }}</span>
                            <strong class="text-slate-navy">{{ $count }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- Daftar Materi -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-xl font-bold mb-6 text-slate-navy">{{ $tableTitle }}</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm table-auto">
                <thead class="bg-off-white border-b border-border-gray">
                    <tr>
                        @foreach($tableHeaders as $header)
                            <th class="p-4 font-semibold text-slate-navy">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
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
                                    {{ \Illuminate\Support\Str::limit($item->deskripsi_materi, 10) }}
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
                                    <a href="{{ route('admin.materi.edit', $item->id) }}"
                                        class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                        <span>Edit</span>
                                    </a>
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Modal Konfirmasi Delete -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96 shadow-xl">
        <h3 class="text-lg font-semibold text-slate-800 mb-4">Hapus Materi</h3>
        <p class="text-slate-600 mb-6">
            Apakah Anda yakin ingin menghapus materi bernama <span id="deleteUserName" class="font-bold"></span>?
            Tindakan ini tidak dapat dibatalkan
        </p>

        <form id="deleteForm" method="POST" class="flex justify-center gap-2">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded hover:underline">
                Batal
            </button>
            <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                Hapus
            </button>
        </form>
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

    // Klik di luar modal tutup modal
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
</script>
