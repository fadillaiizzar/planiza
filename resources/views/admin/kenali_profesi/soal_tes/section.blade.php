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
        'defaultFilterText' => 'Semua Tes',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Daftar Soal Tes -->
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
                    @forelse ($tesList as $index => $tes)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors soal-tes-row"
                            data-tes="{{ strtolower($tes->nama_tes) }}"
                            data-jumlah="{{ strtolower($tes->soal_tes_count) }}"
                        >
                            <td class="p-4 w-[5%]">{{ $tesList->firstItem() + $index }}</td>
                            <td class="p-4 font-medium text-slate-700">{{ $tes->nama_tes }}</td>
                            <td class="p-4">{{ $tes->soal_tes_count }}</td>
                            <td class="p-4">
                                <a href="{{ route('admin.kenali-profesi.soal-tes.show', $tes->id) }}" class="px-4 py-2 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm shadow hover:shadow-md transition">
                                    <i class="fas fa-eye w-4 h-4 mr-2"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state
                            icon="fas fa-list-ul"
                            message="Belum ada tes. Tambahkan data"
                            button="true"
                            buttonAction="openModal()"
                            buttonText="+ Tambah Tes"
                        />
                    @endforelse

                    <x-no-data-row />
                </tbody>
            </table>
        </div>
    </section>
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

    function showEdit(id) {
        fetch(`/admin/kenali-profesi/soal-tes/${id}/edit`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('modalContentEdit').innerHTML = html;
                initEditSoalTesForm();
                openModalEdit();
        });
    }

    function initEditSoalTesForm() {
        const jenisSelect = document.querySelector('#modalEdit #jenis_soal');
        const maxSelectInput = document.querySelector('#modalEdit    #max_select');

        if (jenisSelect && maxSelectInput) {
            const originalMaxSelect = maxSelectInput.value;

            function toggleMaxSelect() {
                if (jenisSelect.value === 'single') {

                    maxSelectInput.dataset.oldValue = maxSelectInput.value;
                    maxSelectInput.value = 1;
                    maxSelectInput.readOnly = true;
                } else if (jenisSelect.value === 'multi') {

                    if (maxSelectInput.dataset.oldValue && maxSelectInput.dataset.oldValue != 1) {
                        maxSelectInput.value = maxSelectInput.dataset.oldValue;
                    } else if (originalMaxSelect && originalMaxSelect != 1) {
                        maxSelectInput.value = originalMaxSelect;
                    } else {
                        maxSelectInput.value = '';
                    }
                    maxSelectInput.readOnly = false;
                } else {
                    maxSelectInput.value = '';
                    maxSelectInput.readOnly = true;
                }
            }

            toggleMaxSelect();

            jenisSelect.addEventListener('change', toggleMaxSelect);
        }
    }

    function openModalEdit() {
        const modal = document.getElementById('modalEdit');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModalEdit() {
        const modal = document.getElementById('modalEdit');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
