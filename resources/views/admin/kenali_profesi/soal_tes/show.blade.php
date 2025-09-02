@extends('layouts.admin')

@section('title', 'Detail Soal Tes - Planiza')

@section('content')
<main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6 md:p-8">
    <div class="mb-8 max-w-4xl mx-auto">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('admin.kenali-profesi.soal-tes.index') }}"
               class="group flex items-center px-4 py-2 rounded-full text-slate-400 hover:text-slate-600 hover:bg-white/70 transition-all duration-200">
                <i class="fas fa-question-circle w-4 h-4 mr-2 text-slate-300 group-hover:text-slate-500"></i>
                <span class="font-medium">Soal Tes</span>
            </a>

            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>

            <div class="flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-slate-600 to-slate-700 text-white shadow-md">
                <i class="fas fa-info-circle w-4 h-4 mr-2"></i>
                <span class="font-semibold">Detail Soal Tes</span>
            </div>
        </nav>
    </div>

    <!-- Card Detail -->
    <div class="max-w-4xl mx-auto space-y-10 overflow-hidden">
        @forelse($tes->soalTes as $soal)
            <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden relative">
                <!-- Header Soal -->
                <div class="bg-gradient-to-r from-slate-500 to-slate-navy px-6 py-4 flex justify-between items-center">
                    <h3 class="text-white font-semibold flex items-center">
                        <i class="fas fa-question-circle mr-2"></i> Soal #{{ $soal->id }}
                    </h3>
                    <div class="flex items-center space-x-3 text-xs text-indigo-100">
                        <span>Terakhir update {{ $soal->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>

                <!-- Content Soal -->
                <div class="p-6 space-y-5">
                    <!-- Pertanyaan -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fas fa-question mr-2 text-yellow-500"></i> Pertanyaan
                        </label>
                        <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl bg-slate-50 text-slate-900">
                            {{ $soal->isi_pertanyaan }}
                        </div>
                    </div>

                    <!-- Jenis Soal -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fas fa-list mr-2 text-green-500"></i> Jenis Soal
                        </label>
                        <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl bg-slate-50 text-slate-900 capitalize">
                            {{ $soal->jenis_soal }}
                        </div>
                    </div>

                    <!-- Max Select -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fas fa-check-double mr-2 text-purple-500"></i> Maksimal Pilihan
                        </label>
                        <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl bg-slate-50 text-slate-900">
                            {{ $soal->jenis_soal === 'single' ? 1 : ($soal->max_select ?? '-') }}
                        </div>
                    </div>

                    <!-- Aksi Soal -->
                    <div class="mt-4 relative">
                        <button onclick="toggleDropdown({{ $soal->id }})"
                                class="px-3 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg text-slate-600 shadow-sm">
                            <i class="fas fa-ellipsis-v mr-3"></i>Aksi
                        </button>

                        <div id="dropdown-{{ $soal->id }}"
                            class="hidden mt-3 flex items-center space-x-4 p-3 bg-white border border-slate-200 rounded-2xl shadow-lg">

                            <!-- Opsi Soal -->
                            <a href="{{ route('admin.kenali-profesi.soal-tes.show', $soal->id) }}"
                            class="flex items-center px-6 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">
                                <i class="fas fa-question-circle mr-2"></i> Opsi
                            </a>

                            <button onclick="showEdit({{ $soal->id }})"
                                class="flex items-center px-6 py-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-100">
                                <i class="fas fa-edit w-5 h-5"></i>
                                <span>Edit</span>
                            </button>

                            <button type="button"
                                onclick="showDeleteModal({{ $soal->id }}, '{{ addslashes($soal->isi_pertanyaan) }}', '{{ route('admin.kenali-profesi.soal-tes.destroy', $soal->id) }}')"
                                class="flex items-center px-6 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">
                                <i class="fas fa-trash-alt w-5 h-5"></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-slate-500 py-20">
                <i class="fas fa-info-circle text-3xl mb-3"></i>
                <p>Belum ada soal untuk tes ini.</p>
            </div>
        @endforelse
    </div>
</main>

<!-- Modal Edit -->
<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
</div>

<!-- Modal Konfirmasi Delete Soal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-2xl border border-[#CBD5E1] relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-red-600"></div>
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1E293B] mb-2">Hapus Soal Tes</h3>
            <p class="text-[#64748B] mb-6 leading-relaxed text-sm sm:text-base">
                Apakah Anda yakin ingin menghapus soal
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
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById('dropdown-' + id);
            dropdown.classList.toggle('hidden');

            document.addEventListener('click', function handler(e) {
                if (!dropdown.contains(e.target) && !e.target.closest('button[onclick^="toggleDropdown"]')) {
                    dropdown.classList.add('hidden');
                    document.removeEventListener('click', handler);
                }
            });
        }

        function showDeleteModal(id, name, action) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteSoalNama').textContent = name;
            const form = document.getElementById('deleteForm');
            form.action = action;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
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
@endpush
