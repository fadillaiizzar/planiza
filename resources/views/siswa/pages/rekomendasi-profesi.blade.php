@extends('layouts.siswa')
@section('title', 'Rekomendasi Profesi')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-off-white via-white to-off-white">
    <div class="px-4 py-8 sm:px-8">
        <x-siswa.section-header
            title="Kenali Profesi Kerja"
            subtitle="Temukan profesi kerja yang sesuai dengan dirimu melalui tes minat dan bakat. Jawab soal sederhana dan dapatkan rekomendasi karier yang cocok untukmu!"
            back-route="siswa.dashboard"
        />
        <x-siswa.info-siswa :siswa="$siswa" />

        <!-- Hero Section dengan Animasi -->
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 relative">
                <!-- Decorative Element -->
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-12 w-32 h-32 bg-slate-navy opacity-5 rounded-full blur-3xl"></div>

                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-slate-navy/5 text-slate-navy text-sm font-semibold rounded-full border border-border-gray/30">
                        ✨ Hasil Analisis Selesai
                    </span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold text-slate-navy mb-6 leading-tight">
                    Karier Impianmu<br/>
                    <span class="bg-gradient-to-r from-slate-navy to-cool-gray bg-clip-text text-transparent">
                        Sudah Menunggu!
                    </span>
                </h1>

                <p class="text-lg text-cool-gray max-w-2xl mx-auto leading-relaxed">
                    Berdasarkan analisis mendalam, kami menemukan tiga profesi yang paling sesuai dengan minat, bakat, dan potensi unikmu.
                </p>
            </div>

            <!-- Top 3 Profesi Cards dengan Ranking Visual -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 mb-16 relative">
                @foreach($topProfesi as $index => $profesi)
                    <div class="group relative {{ $index === 0 ? 'lg:scale-105 lg:-translate-y-4' : '' }} transition-all duration-500 hover:scale-105 hover:-translate-y-2">
                        <!-- Ranking Badge -->
                        <div class="absolute -top-4 -right-4 z-20 w-14 h-14 {{ $index === 0 ? 'bg-slate-navy' : 'bg-cool-gray' }} text-white rounded-full flex items-center justify-center font-bold text-xl shadow-lg border-4 border-white">
                            #{{ $index + 1 }}
                        </div>

                        <!-- Card Container -->
                        <div class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden border border-border-gray/20 h-full flex flex-col relative">
                            <!-- Top Highlight untuk #1 -->
                            @if($index === 0)
                                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-slate-navy via-cool-gray to-slate-navy"></div>
                            @endif

                            <!-- Icon Section dengan Gradient Background -->
                            <div class="relative h-48 bg-gradient-to-br from-slate-navy/5 to-cool-gray/10 flex items-center justify-center overflow-hidden">
                                <!-- Decorative Circles -->
                                <div class="absolute top-4 right-4 w-20 h-20 bg-slate-navy/5 rounded-full"></div>
                                <div class="absolute bottom-6 left-6 w-16 h-16 bg-cool-gray/5 rounded-full"></div>

                                <!-- Icon -->
                                <div class="relative z-10 w-24 h-24 bg-white rounded-2xl shadow-lg flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                                    <i class="fas fa-briefcase text-5xl text-slate-navy"></i>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-6 flex-grow flex flex-col">
                                <!-- Profesi Name -->
                                <h3 class="font-bold text-xl text-slate-navy mb-2 leading-tight">
                                    {{ strtoupper($profesi->profesiKerja->nama_profesi_kerja) }}
                                </h3>

                                <div class="flex items-center gap-2 mb-4">
                                    <span class="px-3 py-1 bg-slate-navy/5 text-slate-navy text-xs font-medium rounded-full">
                                        Profesi Kerja
                                    </span>
                                </div>

                                <!-- Poin Score dengan Visual Bar -->
                                <div class="mb-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-cool-gray">Total Poin</span>
                                        <span class="text-lg font-bold text-slate-navy">{{ $profesi->total_poin }}</span>
                                    </div>
                                    <div class="w-full h-2 bg-border-gray/30 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-slate-navy to-cool-gray rounded-full transition-all duration-1000"
                                             style="width: {{ min(($profesi->total_poin / 100) * 100, 100) }}%">
                                        </div>
                                    </div>
                                </div>

                                <!-- Alasan Section -->
                                <div class="p-4 bg-gradient-to-br from-slate-navy/5 to-transparent rounded-xl mb-6 border border-border-gray/20">
                                    <p class="text-xs font-semibold text-slate-navy mb-1 uppercase tracking-wide">Mengapa cocok?</p>
                                    <p class="text-sm text-cool-gray leading-relaxed">
                                        {{ $alasanFormatted[$profesi->profesi_kerja_id] ?? 'Sesuai dengan profil kemampuanmu' }}
                                    </p>
                                </div>

                                <!-- CTA Button -->
                                <a href="{{ route('siswa.eksplorasi-profesi.show', $profesi->profesiKerja->id) }}"
                                   class="mt-auto group/btn relative inline-flex items-center justify-center px-6 py-3.5 bg-slate-navy text-white rounded-xl font-semibold overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-105">
                                    <span class="relative z-10 flex items-center gap-2">
                                        Lihat Detail Lengkap
                                        <i class="fas fa-arrow-right transform group-hover/btn:translate-x-1 transition-transform"></i>
                                    </span>
                                    <!-- Hover Effect -->
                                    <div class="absolute inset-0 bg-cool-gray transform scale-x-0 group-hover/btn:scale-x-100 transition-transform origin-left"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Bottom Info Section -->
            <div class="max-w-4xl mx-auto text-center">
                <div class="bg-white rounded-2xl shadow-sm border border-border-gray/20 p-8">
                    <div class="w-16 h-16 bg-slate-navy/5 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lightbulb text-3xl text-slate-navy"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-navy mb-3">
                        Langkah Selanjutnya
                    </h3>
                    <p class="text-cool-gray leading-relaxed">
                        Klik "Lihat Detail Lengkap" untuk mempelajari lebih dalam tentang setiap profesi, termasuk jalur pendidikan, skill yang dibutuhkan, dan prospek kariernya.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
