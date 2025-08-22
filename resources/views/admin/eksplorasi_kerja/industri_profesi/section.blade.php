<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'stats' => $stats,
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'defaultFilterText' => 'Semua Profesi',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Statistik Industri - Profesi -->
    <section class="bg-off-white rounded-2xl shadow-lg p-6">
        <x-h3>{{ $statistikTitle }}</x-h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-admin.eksplorasi_kerja.industri-profesi-card
                icon="fas fa-briefcase"
                :label="$labelProfesi"
                :items="$industriPerProfesi"
            />

            <x-admin.eksplorasi_kerja.industri-profesi-card
                icon="fas fa-industry"
                :label="$labelIndustri"
                :items="$profesiPerIndustri"
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
                   @forelse ($items  as $relasi)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors industri-profesi-row"
                            data-profesi="{{ strtolower($relasi->profesiKerja->nama_profesi_kerja) }}"
                            data-industri="{{ strtolower($relasi->industri->nama_industri) }}">
                            <td class="p-4 w-[5%]">{{ $relasi->id }}</td>
                            <td class="p-4 w-[40%]">{{ Str::limit($relasi->profesiKerja->nama_profesi_kerja, 50) }}</td>
                            <td class="p-4 w-[40%]">{{ Str::limit($relasi->industri->nama_industri, 50) }}</td>
                            <td class="p-4 relative overflow-visible w-[15%]">
                                <button onclick="toggleDropdown({{ $relasi->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $relasi->id }}" class="hidden absolute right-32 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">
                                    <a href="{{ route('admin.industri-profesi.show', $relasi->id) }}"
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
                                    <form action="{{ route('admin.industri-profesi.destroy', $relasi->id) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="showDeleteRelasiModal(
                                                {{ $relasi->id }},
                                                '{{ addslashes($relasi->industri->nama_industri) }}',
                                                '{{ addslashes($relasi->profesiKerja->nama_profesi_kerja) }}',
                                                '{{ route('admin.industri-profesi.destroy', $relasi->id) }}'
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
                            colspan="4"
                            icon="fas fa-link"
                            message="Belum ada relasi industri ↔ profesi. Tambahkan data"
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

<!-- Modal Konfirmasi Delete Relasi Industri - Profesi -->
<div id="deleteRelasiModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4">
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

            <h3 class="text-xl font-bold text-[#1E293B] mb-2">Hapus Relasi Industri - Profesi</h3>
            <p class="text-[#64748B] mb-6 leading-relaxed text-sm sm:text-base">
                Apakah Anda yakin ingin menghapus relasi
                <br>
                <span id="deleteRelasiIndustri"></span>
                ↔
                <span id="deleteRelasiProfesi"></span> ?
                <br>
                <span class="text-sm text-red-500 mt-2 block">Tindakan ini tidak dapat dibatalkan</span>
            </p>

            <form id="deleteRelasiForm" method="POST" class="flex flex-row justify-center gap-5">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteRelasiModal()"
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
    function showDeleteRelasiModal(id, industriName, profesiName, action) {
        document.getElementById('deleteRelasiModal').classList.remove('hidden');
        document.getElementById('deleteRelasiIndustri').textContent = industriName;
        document.getElementById('deleteRelasiProfesi').textContent = profesiName;
        const form = document.getElementById('deleteRelasiForm');
        form.action = action;
    }

    function closeDeleteRelasiModal() {
        document.getElementById('deleteRelasiModal').classList.add('hidden');
    }

    function showEdit(id) {
        fetch(`/admin/industri-profesi/${id}/edit`)
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
