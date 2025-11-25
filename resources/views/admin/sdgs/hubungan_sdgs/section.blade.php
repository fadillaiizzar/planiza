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

                            <td class="p-4 w-[20%]">
                                {{ $relasi->kategoriSdgs->nomor_kategori }} - {{ Str::limit($relasi->kategoriSdgs->nama_kategori, 27) }}
                            </td>

                            <td class="p-4 w-[23%]">
                                {{ $relasi->profesiKerja ? Str::limit($relasi->profesiKerja->nama_profesi_kerja, 30) : '-' }}
                            </td>

                            <td class="p-4 w-[23%]">
                                {{ $relasi->jurusanKuliah ? Str::limit($relasi->jurusanKuliah->nama_jurusan_kuliah, 30) : '-' }}
                            </td>

                            <td class="p-4 w-[15%]">
                                {{ $relasi->created_at ? $relasi->created_at->format('d M Y') : '-' }}
                            </td>

                            <td class="p-4 relative overflow-visible w-[5%]">
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

@include('admin.sdgs.hubungan_sdgs.delete')

<script>
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
