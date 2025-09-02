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
            @php
                $fields = [
                    [
                        'icon' => 'fas fa-hashtag',
                        'color' => 'text-red-500',
                        'label' => 'ID Soal Tes',
                        'value' => $soalTes->id,
                    ],
                    [
                        'icon' => 'fas fa-vial',
                        'color' => 'text-purple-500',
                        'label' => 'Nama Tes',
                        'value' => $soalTes->tes->nama_tes ?? '-',
                    ],
                    [
                        'icon' => 'fas fa-question',
                        'color' => 'text-yellow-500',
                        'label' => 'Isi Pertanyaan',
                        'value' => $soalTes->isi_pertanyaan,
                    ],
                    [
                        'icon' => 'fas fa-list',
                        'color' => 'text-green-500',
                        'label' => 'Jenis Soal',
                        'value' => $soalTes->jenis_soal,
                    ],
                ];
            @endphp

            @foreach ($fields as $field)
                <x-admin.detail-field
                    :icon="$field['icon']"
                    :colorIcon="$field['color']"
                    :label="$field['label']"
                    :value="$field['value']"
                />
            @endforeach
            
            <!-- Max Select -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-check-double mr-2 text-purple-500"></i> Maksimal Pilihan
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    @if($soalTes->jenis_soal === 'single')
                        1
                    @else
                        {{ $soalTes->max_select ?? '-' }}
                    @endif
                </div>
            </div>
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
