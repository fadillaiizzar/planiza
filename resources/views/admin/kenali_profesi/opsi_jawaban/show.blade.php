@extends('layouts.admin')

@section('title', 'Detail Opsi Jawaban - Planiza')

@section('content')
<main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6 md:p-8">
    <div class="mb-8 max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('admin.kenali-profesi.opsi-jawaban.index') }}"
               class="group flex items-center px-4 py-2 rounded-full text-slate-400 hover:text-slate-600 hover:bg-white/70 transition-all duration-200">
                <i class="fas fa-list w-4 h-4 mr-2 text-slate-300 group-hover:text-slate-500"></i>
                <span class="font-medium">Opsi Jawaban</span>
            </a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <div class="flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-slate-600 to-slate-700 text-white shadow-md">
                <i class="fas fa-info-circle w-4 h-4 mr-2"></i>
                <span class="font-semibold">Detail Opsi Jawaban</span>
            </div>
        </nav>
    </div>

    <!-- Card Detail -->
    <div class="w-full max-w-4xl mx-auto text-left bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-slate-600 to-slate-700 px-8 py-6">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-list text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Detail Opsi Jawaban</h2>
                    <p class="text-slate-200 text-sm">Informasi lengkap opsi jawaban</p>
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
                        'label' => 'ID Opsi Jawaban',
                        'value' => $opsiJawaban->id,
                    ],
                    [
                        'icon' => 'fas fa-vial',
                        'color' => 'text-purple-500',
                        'label' => 'Tes',
                        'value' => $opsiJawaban->soalTes->tes->nama_tes ?? '-',
                    ],
                    [
                        'icon' => 'fas fa-question-circle',
                        'color' => 'text-blue-500',
                        'label' => 'Soal Tes',
                        'value' => $opsiJawaban->soalTes->isi_pertanyaan ?? '-',
                    ],
                    [
                        'icon' => 'fas fa-align-left',
                        'color' => 'text-indigo-500',
                        'label' => 'Isi Opsi',
                        'value' => $opsiJawaban->isi_opsi,
                    ],
                    [
                        'icon' => 'fas fa-star',
                        'color' => 'text-yellow-500',
                        'label' => 'Poin',
                        'value' => $opsiJawaban->poin,
                    ],
                ];
            @endphp

            @foreach($fields as $field)
                <x-admin.detail-field
                    :icon="$field['icon']"
                    :colorIcon="$field['color']"
                    :label="$field['label']"
                    :value="$field['value']"
                />
            @endforeach

            <!-- Kategori Minat -->
            @if($opsiJawaban->soalTes->jenis_soal === 'single' && $opsiJawaban->kategoriMinat)
                <x-admin.detail-field
                    icon="fas fa-tags"
                    colorIcon="text-green-500"
                    label="Kategori Minat"
                    :value="$opsiJawaban->kategoriMinat->nama_kategori"
                />

                {{-- Profesi Terkait --}}
                <div class="group">
                    <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                        <i class="fas fa-users mr-2 text-orange-500"></i> Profesi Terkait
                    </label>
                    @if($opsiJawaban->kategoriMinat->profesiKerjas->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($opsiJawaban->kategoriMinat->profesiKerjas as $profesi)
                                <div class="px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm flex items-center">
                                    <i class="fas fa-briefcase mr-2 text-slate-navy"></i>
                                    <span>{{ $profesi->nama_profesi_kerja }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl bg-white shadow-sm">
                            <p class="text-sm text-slate-500">Tidak ada profesi terkait</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Profesi Kerja -->
            @if($opsiJawaban->soalTes->jenis_soal === 'multi' && $opsiJawaban->profesiKerja)
                <x-admin.detail-field
                    icon="fas fa-briefcase"
                    colorIcon="text-slate-navy"
                    label="Profesi Kerja"
                    :value="$opsiJawaban->profesiKerja->nama_profesi_kerja"
                />
            @endif
        </div>

        <!-- Footer -->
        <div class="px-8 py-5 bg-slate-50 border-t border-slate-100">
            <div class="flex items-center justify-between text-left">
                <div class="text-xs text-slate-500">
                    <span class="flex items-center">
                        <i class="fas fa-clock w-3 h-3 mr-1"></i>
                        Terakhir diperbarui: {{ $opsiJawaban->updated_at->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
