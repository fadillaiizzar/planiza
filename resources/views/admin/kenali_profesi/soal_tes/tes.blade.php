@extends('layouts.admin')

@section('title', 'Tambah Soal Tes - Planiza')

@section('content')
<main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6 md:p-8">
    <div class="mb-8 max-w-4xl mx-auto">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('admin.kenali-profesi.soal-tes.index') }}"
               class="group flex items-center px-4 py-2 rounded-full text-slate-400 hover:text-slate-600 hover:bg-white/70 transition-all duration-200">
                <i class="fas fa-list-ul w-4 h-4 mr-2 text-slate-300 group-hover:text-slate-500"></i>
                <span class="font-medium">Soal Tes</span>
            </a>

            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>

            <div class="flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-slate-700 to-slate-800 text-white shadow-md">
                <i class="fas fa-plus-circle w-4 h-4 mr-2"></i>
                <span class="font-semibold">Tambah Soal Tes</span>
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
                    <h2 class="text-xl font-bold text-white">Tambah Soal Tes</h2>
                    <p class="text-slate-200 text-sm">Isi detail soal untuk ditambahkan</p>
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
        <form action="{{ route('admin.kenali-profesi.soal-tes.store') }}" method="POST" class="px-6 pt-2 pb-6 space-y-4">
            @csrf

            {{-- Dropdown Tes --}}
            <div class="group space-y-1">
                <label for="tes_id" class="block text-sm font-semibold text-slate-700 mb-2">
                    <i class="fas fa-vial mr-2 text-indigo-500"></i> Tes
                </label>
                <select name="tes_id" id="tes_id"
                    class="w-full px-5 py-3 border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400 @error('tes_id') border-red-500 @enderror" required>
                    <option value="">-- Pilih Tes --</option>
                    @foreach ($tesList as $tes)
                        <option value="{{ $tes->id }}" {{ old('tes_id', $selectedTesId ?? '') == $tes->id ? 'selected' : '' }}>
                            {{ $tes->nama_tes }}
                        </option>
                    @endforeach
                </select>
                @error('tes_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Isi Pertanyaan --}}
            <div class="group space-y-1">
                <label for="isi_pertanyaan" class="block text-sm font-semibold text-slate-700 mb-2">
                    <i class="fas fa-question-circle mr-2 text-green-500"></i> Isi Pertanyaan
                </label>
                <textarea name="isi_pertanyaan" id="isi_pertanyaan" rows="3"
                    class="w-full px-5 py-3 border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400 @error('isi_pertanyaan') border-red-500 @enderror"
                    required>{{ old('isi_pertanyaan') }}</textarea>
                @error('isi_pertanyaan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Jenis Soal --}}
            @php
                $jenisSoal = ['single' => 'Single', 'multi' => 'Multi'];
            @endphp
            <div class="group space-y-1">
                <label for="jenis_soal" class="block text-sm font-semibold text-slate-700 mb-2">
                    <i class="fas fa-check-double mr-2 text-purple-500"></i> Jenis Soal
                </label>
                <select name="jenis_soal" id="jenis_soal"
                    class="w-full px-5 py-3 border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400 @error('jenis_soal') border-red-500 @enderror" required>
                    <option value="">-- Pilih Jenis Soal --</option>
                    @foreach ($jenisSoal as $key => $value)
                        <option value="{{ $key }}" {{ old('jenis_soal') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_soal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Max Select --}}
            <div class="group space-y-1">
                <label for="max_select" class="block text-sm font-semibold text-slate-700 mb-2">
                    <i class="fas fa-sort-numeric-up-alt mr-2 text-orange-500"></i> Maksimal Pilihan
                </label>
                <input type="number" name="max_select" id="max_select"
                    value="{{ old('max_select') }}"
                    class="w-full px-5 py-3 border border-slate-200 rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400 @error('max_select') border-red-500 @enderror"
                    placeholder="Isi jika Multi">
                @error('max_select') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-center pt-4 gap-5">
                <button onclick="closeModal()" type="button"
                    class="text-slate-600 hover:text-slate-800 font-medium transition-all duration-200 hover:underline">
                    Batal
                </button>
                <button type="submit"
                    class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</main>

{{-- Script Dinamis --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jenisSelect = document.getElementById('jenis_soal');
        const maxSelectInput = document.getElementById('max_select');

        function toggleMaxSelect() {
            if (jenisSelect.value === 'single') {
                maxSelectInput.value = 1;
                maxSelectInput.readOnly = true;
            } else if (jenisSelect.value === 'multi') {
                maxSelectInput.value = '';
                maxSelectInput.readOnly = false;
            } else {
                maxSelectInput.value = '';
                maxSelectInput.readOnly = true;
            }
        }

        jenisSelect.addEventListener('change', toggleMaxSelect);
        toggleMaxSelect(); 
    });
</script>
@endsection
