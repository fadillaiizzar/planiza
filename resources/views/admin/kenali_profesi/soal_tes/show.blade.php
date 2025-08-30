@extends('layouts.admin')

@section('title', 'Detail Soal Tes - Planiza')

@section('content')
<main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6 md:p-8">
    <div class="mb-8 max-w-4xl mx-auto">

        <!-- Breadcrumb -->
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
    <div class="w-full max-w-4xl mx-auto text-left bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-slate-600 to-slate-700 px-8 py-6">
            <div class="flex items-center space-x-3 text-left justify-start">
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-question-circle text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Detail Soal Tes</h2>
                    <p class="text-slate-200 text-sm">Informasi lengkap soal tes</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-8 pt-8 pb-0 space-y-5">

            <!-- ID -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-hashtag mr-2 text-slate-500"></i> ID Soal Tes
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    {{ $soalTes->id }}
                </div>
            </div>

            <!-- Tes -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-vial mr-2 text-blue-500"></i> Nama Tes
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    {{ $soalTes->tes->nama_tes ?? '-' }}
                </div>
            </div>

            <!-- Isi Pertanyaan -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-question mr-2 text-indigo-500"></i> Isi Pertanyaan
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    {{ $soalTes->isi_pertanyaan }}
                </div>
            </div>

            <!-- Jenis Soal -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-list mr-2 text-green-500"></i> Jenis Soal
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm capitalize">
                    {{ $soalTes->jenis_soal }}
                </div>
            </div>

            <!-- Max Select -->
            @if($soalTes->jenis_soal === 'multi')
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-check-double mr-2 text-purple-500"></i> Maksimal Pilihan
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    {{ $soalTes->max_select ?? '-' }}
                </div>
            </div>
            @endif

        </div>

        <!-- Footer -->
        <div class="px-8 py-5 bg-slate-50 border-t border-slate-100">
            <div class="flex items-center justify-between text-left">
                <div class="text-xs text-slate-500">
                    <span class="flex items-center">
                        <i class="fas fa-clock w-3 h-3 mr-1"></i>
                        Terakhir diperbarui: {{ $soalTes->updated_at->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
