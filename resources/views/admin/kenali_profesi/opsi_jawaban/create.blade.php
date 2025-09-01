@extends('layouts.admin')

@section('title', 'Tambah Opsi Jawaban - Planiza')

@section('content')
<main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6 md:p-8">
    <div class="mb-8 max-w-4xl mx-auto">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('admin.kenali-profesi.opsi-jawaban.index') }}"
               class="group flex items-center px-4 py-2 rounded-full text-slate-400 hover:text-slate-600 hover:bg-white/70 transition-all duration-200">
                <i class="fas fa-list-ul w-4 h-4 mr-2 text-slate-300 group-hover:text-slate-500"></i>
                <span class="font-medium">Opsi Jawaban</span>
            </a>

            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>

            <div class="flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-slate-700 to-slate-800 text-white shadow-md">
                <i class="fas fa-plus-circle w-4 h-4 mr-2"></i>
                <span class="font-semibold">Tambah Opsi Jawaban</span>
            </div>
        </nav>
    </div>

    <!-- Card Form -->
    <div class="w-full max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">

        <!-- Form Header -->
        <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-pen text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Tambah Opsi Jawaban</h2>
                    <p class="text-slate-200 text-sm">Isi detail opsi jawaban untuk soal tes</p>
                </div>
            </div>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mx-6 mt-4 px-3 py-2 bg-red-50 border-l-4 border-red-400 rounded-r-lg">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <h4 class="text-red-800 font-medium text-sm">Terdapat kesalahan:</h4>
                </div>
                <ul class="text-sm text-red-700 list-disc pl-6 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Content -->
        <form action="{{ route('admin.kenali-profesi.opsi-jawaban.store') }}" method="POST" class="px-6 pt-2 pb-6 space-y-4">
            @csrf

            {{-- Dropdown Soal Tes --}}
            <div class="group space-y-1">
                <label for="soal_tes_id" class="block text-sm font-semibold text-slate-700 mb-2">
                    <i class="fas fa-question-circle mr-2 text-indigo-500"></i> Soal Tes
                </label>
                <select name="soal_tes_id" id="soal_tes_id"
                    class="w-full px-5 py-3 border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400"
                    required>
                    <option value="">-- Pilih Soal Tes --</option>
                    @foreach ($soalTesList as $soal)
                        <option value="{{ $soal->id }}"
                            data-jenis="{{ $soal->jenis_soal }}"
                            {{ old('soal_tes_id', $selectedSoalTesId ?? '') == $soal->id ? 'selected' : '' }}>
                            {{ $soal->isi_pertanyaan }}
                        </option>
                    @endforeach
                </select>
                @error('soal_tes_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Container Opsi --}}
            <div id="opsi-container" class="space-y-6">
                <div class="opsi-item p-5 rounded-2xl border border-slate-200 shadow-sm bg-slate-50">
                    <div class="group space-y-1 mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-green-500"></i> Isi Opsi
                        </label>
                        <input type="text" name="isi_opsi[]" class="w-full px-5 py-3 border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400" required>
                    </div>

                    <div class="group space-y-1 mb-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fas fa-star mr-2 text-yellow-500"></i> Poin
                        </label>
                        <input type="number" name="poin[]" class="w-full px-5 py-3 border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400" required>
                    </div>

                    {{-- Placeholder kategori/profesi (ditampilkan dinamis via JS sesuai jenis soal) --}}
                    <div class="group space-y-1 mb-4 kategori-field hidden">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fas fa-tags mr-2 text-blue-500"></i> Kategori Minat
                        </label>
                        <select name="kategori_minat_id[]" class="w-full px-5 py-3 border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400">
                            <option value="">-- Pilih Kategori Minat --</option>
                            @foreach ($kategoriMinatList as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="group space-y-1 mb-4 profesi-field hidden">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="fas fa-briefcase mr-2 text-emerald-500"></i> Profesi Kerja
                        </label>
                        <select name="profesi_kerja_id[]" class="w-full px-5 py-3 border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400">
                            <option value="">-- Pilih Profesi Kerja --</option>
                            @foreach ($profesiKerjaList as $profesi)
                                <option value="{{ $profesi->id }}">{{ $profesi->nama_profesi_kerja }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Button Tambah Opsi --}}
            <div class="flex justify-start">
                <button type="button" id="add-opsi"
                    class="mt-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold px-4 py-2 rounded-xl shadow-md transition-all duration-200">
                    <i class="fas fa-plus mr-2"></i> Tambah Opsi
                </button>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-center pt-6 gap-5">
                <a href="{{ route('admin.kenali-profesi.opsi-jawaban.index') }}"
                    class="text-slate-600 hover:text-slate-800 font-medium transition-all duration-200 hover:underline">
                    Batal
                </a>
                <button type="submit"
                    class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200">
                    Simpan Semua
                </button>
            </div>
        </form>
    </div>
</main>

{{-- Script Dinamis --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('opsi-container');
        const addBtn = document.getElementById('add-opsi');
        const soalSelect = document.getElementById('soal_tes_id');

        // toggle kategori/profesi berdasarkan jenis soal
        function toggleFields() {
            const selectedOption = soalSelect.options[soalSelect.selectedIndex];
            const jenisSoal = selectedOption ? selectedOption.getAttribute('data-jenis') : null;

            container.querySelectorAll('.opsi-item').forEach(item => {
                item.querySelector('.kategori-field').classList.add('hidden');
                item.querySelector('.profesi-field').classList.add('hidden');
                if (jenisSoal === 'single') {
                    item.querySelector('.kategori-field').classList.remove('hidden');
                } else if (jenisSoal === 'multi') {
                    item.querySelector('.profesi-field').classList.remove('hidden');
                }
            });
        }

        soalSelect.addEventListener('change', toggleFields);

        addBtn.addEventListener('click', function () {
            const newOpsi = container.firstElementChild.cloneNode(true);
            newOpsi.querySelectorAll('input, select').forEach(el => {
                el.value = '';
            });
            container.appendChild(newOpsi);
            toggleFields();
        });

        // 🔑 panggil sekali saat halaman load
        toggleFields();
    });
</script>
@endsection
