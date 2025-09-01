<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'addRoute' => $addRoute,
        'userCount' => $userCount,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'defaultFilterText' => 'Semua Soal Tes',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Daftar Opsi Jawaban -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-navy mb-4">Daftar Opsi Jawaban</h3>

        <div class="overflow-x-auto scrollbar-none">
            <table class="w-full text-left text-sm table-auto">
                <thead class="bg-off-white border-b border-border-gray">
                    <tr>
                        <th class="p-4 font-semibold text-slate-navy">ID</th>
                        <th class="p-4 font-semibold text-slate-navy">Soal Tes</th>
                        <th class="p-4 font-semibold text-slate-navy">Isi Opsi</th>
                        <th class="p-4 font-semibold text-slate-navy">Poin</th>
                        <th class="p-4 font-semibold text-slate-navy">Kategori / Profesi</th>
                        <th class="p-4 font-semibold text-slate-navy">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors opsi-jawaban-row"
                            data-soal="{{ strtolower($item->soalTes->isi_pertanyaan ?? '') }}"
                            data-opsi="{{ strtolower($item->isi_opsi) }}"
                            data-poin="{{ $item->poin }}"
                        >
                            <td class="p-4">{{ $item->id }}</td>
                            <td class="p-4 font-medium text-slate-700">
                                {{ Str::limit($item->soalTes->isi_pertanyaan ?? '-', 30) }}
                            </td>
                            <td class="p-4">{{ Str::limit($item->isi_opsi, 40) }}</td>
                            <td class="p-4">{{ $item->poin }}</td>
                            <td class="p-4">
                                @if($item->kategoriMinat)
                                    <span class="text-blue-600">{{ $item->kategoriMinat->nama_kategori }}</span>
                                @elseif($item->profesiKerja)
                                    <span class="text-green-600">{{ $item->profesiKerja->nama_profesi_kerja }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="p-4 relative overflow-visible">
                                <button onclick="toggleDropdown({{ $item->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $item->id }}" class="hidden absolute right-16 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[160px]">
                                    <a href="{{ route('admin.kenali-profesi.opsi-jawaban.show', $item->id) }}"
                                        class="px-5 py-3 hover:bg-blue-50 flex items-center gap-3 text-blue-600 transition-colors text-base w-full text-left">
                                        <i class="fas fa-eye w-5 h-5"></i>
                                        <span>Detail</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <a href="{{ route('admin.kenali-profesi.opsi-jawaban.edit', $item->id) }}"
                                        class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base w-full text-left">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                        <span>Edit</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <button type="button"
                                        onclick="showDeleteModal({{ $item->id }}, '{{ addslashes($item->isi_opsi) }}', '{{ route('admin.kenali-profesi.opsi-jawaban.destroy', $item->id) }}')"
                                        class="px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base w-full text-left">
                                        <i class="fas fa-trash-alt w-5 h-5"></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state
                            icon="fas fa-list-ul"
                            message="Belum ada opsi jawaban. Tambahkan data"
                            button="true"
                            buttonAction="openModal()"
                            buttonText="+ Tambah Opsi Jawaban"
                        />
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Modal Delete Opsi Jawaban -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-2xl border border-[#CBD5E1] relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-red-600"></div>
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1E293B] mb-2">Hapus Opsi Jawaban</h3>
            <p class="text-[#64748B] mb-6 leading-relaxed text-sm sm:text-base">
                Apakah Anda yakin ingin menghapus opsi
                <span id="deleteSoalNama"></span> ?
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
