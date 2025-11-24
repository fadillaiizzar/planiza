<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'stats' => $stats,
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'defaultFilterText' => 'Semua Kategori',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Statistik Hubungan SDGs -->
    <section class="bg-off-white rounded-2xl shadow-lg p-6">
        <x-h3>{{ $statistikTitle }}</x-h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.sdgs.statistic-card
                icon="fas fa-briefcase"
                :label="$labelProfesi"
                :items="$profesiPerKategori"
            />

            <x-admin.sdgs.statistic-card
                icon="fas fa-graduation-cap"
                :label="$labelJurusan"
                :items="$jurusanPerKategori"
            />
        </div>
    </section>

    <!-- Daftar Relasi -->
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
                    @forelse ($items as $relasi)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors hubungan-sdgs-row"
                            data-kategori="{{ strtolower($relasi->kategoriSdgs->nama_kategori) }}"
                            data-profesi="{{ strtolower($relasi->profesiKerja->nama_profesi_kerja ?? '') }}"
                            data-jurusan="{{ strtolower($relasi->jurusanKuliah->nama_jurusan ?? '') }}"
                        >
                            <td class="p-4 w-[5%]">{{ $relasi->id }}</td>

                           <td class="p-4 w-[25%]">
                                {{ $relasi->kategoriSdgs->nomor_kategori }} - {{ Str::limit($relasi->kategoriSdgs->nama_kategori, 50) }}
                            </td>

                            <td class="p-4 w-[30%]">
                                {{ $relasi->profesiKerja ? Str::limit($relasi->profesiKerja->nama_profesi_kerja, 50) : '-' }}
                            </td>

                            <td class="p-4 w-[30%]">
                                {{ $relasi->jurusanKuliah ? Str::limit($relasi->jurusanKuliah->nama_jurusan_kuliah, 50) : '-' }}
                            </td>

                            <td class="p-4 relative overflow-visible w-[10%]">
                                <button onclick="toggleDropdown({{ $relasi->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $relasi->id }}"
                                    class="hidden absolute right-32 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">

                                    <a href="{{ route('admin.sdgs.hubungan-sdgs.show', $relasi->id) }}"
                                        class="px-5 py-3 hover:bg-yellow-50 flex gap-3 text-blue-600 text-base">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>

                                    <div class="border-t border-border-gray"></div>

                                    <button onclick="showEdit({{ $relasi->id }})"
                                        class="px-5 py-3 hover:bg-green-50 flex gap-3 text-green-600 text-base">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <div class="border-t border-border-gray"></div>

                                    <button type="button"
                                        onclick="showDeleteRelasiModal(
                                            {{ $relasi->id }},
                                            '{{ addslashes($relasi->kategoriSdgs->nama_kategori) }}',
                                            '{{ addslashes($relasi->profesiKerja->nama_profesi_kerja ?? '-') }}',
                                            '{{ addslashes($relasi->jurusanKuliah->nama_jurusan_kuliah ?? '-') }}',
                                            '{{ route('admin.sdgs.hubungan-sdgs.destroy', $relasi->id) }}'
                                        )"
                                        class="px-5 py-3 hover:bg-red-50 flex gap-3 text-red-600 text-base">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty

                        <x-empty-state
                            colspan="5"
                            icon="fas fa-project-diagram"
                            message="Belum ada hubungan SDGs. Tambah data sekarang"
                            button="true"
                            buttonAction="openModal()"
                            buttonText="+ Tambah Relasi"
                        />

                    @endforelse

                    <x-no-data-row />
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Modal Delete -->
<div id="deleteRelasiModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4">

    <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-2xl border border-[#CBD5E1] relative overflow-hidden">

        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-red-600"></div>

        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-[#1E293B] mb-2">Hapus Relasi SDGs</h3>

            <p class="text-[#64748B] mb-6 leading-relaxed text-sm sm:text-base">
                Yakin ingin menghapus relasi:
                <br>
                <span id="deleteKategori"></span>
                ↔
                <span id="deleteProfesi"></span>
                ↔
                <span id="deleteJurusan"></span>
                <br>
                <span class="text-red-500 text-sm block mt-2">Tindakan ini tidak dapat dibatalkan.</span>
            </p>

            <form id="deleteRelasiForm" method="POST" class="flex justify-center gap-5">
                @csrf
                @method('DELETE')

                <button type="button" onclick="closeDeleteRelasiModal()"
                    class="hover:underline text-gray-500">Batal</button>

                <button type="submit"
                    class="px-6 py-2 rounded-full bg-gradient-to-r from-red-500 to-red-600 text-white shadow-md">
                    Hapus
                </button>
            </form>

        </div>
    </div>
</div>

<script>
    function showDeleteRelasiModal(id, kategori, profesi, jurusan, action) {
        document.getElementById('deleteRelasiModal').classList.remove('hidden');
        document.getElementById('deleteKategori').innerText = kategori;
        document.getElementById('deleteProfesi').innerText = profesi;
        document.getElementById('deleteJurusan').innerText = jurusan;
        document.getElementById('deleteRelasiForm').action = action;
    }

    function closeDeleteRelasiModal() {
        document.getElementById('deleteRelasiModal').classList.add('hidden');
    }

    function showEdit(id) {
        fetch(`/admin/sdgs/hubungan-sdgs/${id}/edit`)
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
