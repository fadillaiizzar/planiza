<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'stats' => $stats,
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'defaultFilterText' => 'Semua Jurusan',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Statistik Kampus - Jurusan -->
    <section class="bg-off-white rounded-2xl shadow-lg p-6">
        <x-h3>{{ $statistikTitle }}</x-h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.eksplorasi_kuliah.kampus-jurusan-card
                icon="fas fa-book"
                :label="$labelJurusan"
                :items="$kampusPerJurusan"
            />

            <x-admin.eksplorasi_kuliah.kampus-jurusan-card
                icon="fas fa-university"
                :label="$labelKampus"
                :items="$jurusanPerKampus"
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
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors kampus-jurusan-row"
                            data-kampus="{{ strtolower($relasi->kampus->nama_kampus) }}"
                            data-jurusan="{{ strtolower($relasi->jurusanKuliah->nama_jurusan_kuliah) }}">
                            <td class="p-4 w-[5%]">{{ $relasi->id }}</td>
                            <td class="p-4 w-[30%]">{{ Str::limit($relasi->kampus->nama_kampus, 50) }}</td>
                            <td class="p-4 w-[30%]">{{ Str::limit($relasi->jurusanKuliah->nama_jurusan_kuliah, 50) }}</td>
                            <td class="p-4 w-[20%]">{{ $relasi->passing_grade }}</td>
                            <td class="p-4 relative overflow-visible w-[10%]">
                                <button onclick="toggleDropdown({{ $relasi->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $relasi->id }}" class="hidden absolute right-14 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">
                                    <a href="{{ route('admin.eksplorasi-jurusan.kampus-jurusan.show', $relasi->id) }}"
                                        class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                        <i class="fas fa-eye w-5 h-5"></i>
                                        <span>Detail</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <button onclick="showEdit({{ $relasi->id }})"
                                        class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                        <span>Edit</span>
                                    </button>
                                    <div class="border-t border-border-gray"></div>
                                    <form action="{{ route('admin.eksplorasi-jurusan.kampus-jurusan.destroy', $relasi->id) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="showDeleteRelasiModal(
                                                {{ $relasi->id }},
                                                '{{ addslashes($relasi->kampus->nama_kampus) }}',
                                                '{{ addslashes($relasi->jurusanKuliah->nama_jurusan_kuliah) }}',
                                                '{{ route('admin.eksplorasi-jurusan.kampus-jurusan.destroy', $relasi->id) }}'
                                            )"
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
                            colspan="5"
                            icon="fas fa-project-diagram"
                            message="Belum ada relasi kampus ↔ jurusan. Tambahkan data baru"
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

<script>
    function showEdit(id) {
        fetch(`/admin/eksplorasi-jurusan/kampus-jurusan/${id}/edit`)
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
