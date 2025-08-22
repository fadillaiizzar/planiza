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
        <h3 class="text-xl font-bold text-slate-navy mb-6">{{ $statistikTitle }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl border border-border-gray shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
                <h4 class="text-lg font-semibold text-slate-navy mb-4">{{ $iconKelas ?? '💼' }} {{ $labelKelas }}</h4>
                <ul class="space-y-2 text-cool-gray">
                    @foreach(($allProfesi->groupBy('industri') ?? []) as $industri => $profesi)
                        <li class="flex justify-between items-center border-b border-border-gray pb-1 last:border-none last:pb-0">
                            <span>{{ $industri ?: 'Tidak ada industri' }}</span>
                            <strong class="text-slate-navy">{{ $profesi->count() }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- Daftar Profesi -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-xl font-bold mb-6 text-slate-navy">{{ $tableTitle }}</h3>
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
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors">
                            <td class="p-4">{{ $item->id }}</td>
                            <td class="p-4">{{ Str::limit($item->nama_profesi_kerja, 15) }}</td>
                            <td class="p-4">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama_profesi_kerja }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="p-4">Rp{{ number_format($item->gaji, 0, ',', '.') }}</td>
                            <td class="p-4">{{ Str::limit($item->deskripsi, 12) }}</td>
                            <td class="p-4">{{ Str::limit($item->info_skill, 12) }}</td>
                            <td class="p-4">{{ Str::limit($item->info_jurusan, 12) }}</td>
                            <td class="p-4 relative overflow-visible">
                                <button onclick="toggleDropdown({{ $item->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $item->id }}" class="hidden absolute right-12 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">
                                    <a href="{{ route('admin.profesi-kerja.show', $item->id) }}"
                                        class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                        <i class="fas fa-eye w-5 h-5"></i>
                                        <span>Detail</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <button onclick="showEdit({{ $item->id }})"
                                        class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                        <span>Edit</span>
                                    </button>
                                    <div class="border-t border-border-gray"></div>
                                    <form action="{{ route('admin.profesi-kerja.destroy', $item->id) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="showDeleteModal({{ $item->id }}, '{{ addslashes($item->nama_profesi_kerja) }}', '{{ route('admin.profesi-kerja.destroy', $item->id) }}')"
                                            class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base">
                                            <i class="fas fa-trash-alt w-5 h-5"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-10">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <i class="fas fa-user-tie text-gray-400 text-4xl"></i>
                                    <p class="text-gray-500 text-lg font-medium">
                                       Belum ada profesi kerja. Tambahkan data
                                    </p>
                                    <button onclick="openModal()"
                                        class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300
                                            border border-cool-gray text-cool-gray
                                            hover:bg-cool-gray hover:text-off-white hover:scale-105
                                            focus:ring-4 focus:ring-cool-gray">
                                        + Tambah Profesi
                                </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    <tr id="noDataRow" class="hidden">
                        <td colspan="6" class="text-center py-10">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <i class="fas fa-search text-gray-400 text-4xl"></i>
                                <p class="text-gray-500 text-lg font-medium">
                                    Tidak ada data yang sesuai dengan pencarian atau filter
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Modal Konfirmasi Delete -->
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

            <h3 class="text-xl font-bold text-[#1E293B] mb-2">Hapus Profesi Kerja</h3>
            <p class="text-[#64748B] mb-6 leading-relaxed text-sm sm:text-base">
                Apakah Anda yakin ingin menghapus profesi kerja
                <span id="deleteProfesiName"></span> ?
                <br>
                <span class="text-sm text-red-500 mt-2 block">Tindakan ini tidak dapat dibatalkan</span>
            </p>

            <form id="deleteForm" method="POST" class="flex flex-row justify-center gap-5">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()"
                        class="hover:underline text-[#64748B] hover:bg-[#F9FAFB] transition-all duration-200 font-medium w-full sm:w-auto">
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
    function showDeleteModal(id, name, action) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteProfesiName').textContent = name;
        const form = document.getElementById('deleteForm');
        form.action = action;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    function showEdit(id) {
        fetch(`/admin/profesi-kerja/${id}/edit`)
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
