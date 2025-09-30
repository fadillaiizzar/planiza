@extends('layouts.siswa')

@section('title', 'Rekomendasi Profesi')

@section('content')
<div class="px-4 py-8 sm:px-8">
    <x-siswa.section-header
        title="Kenali Profesi Kerja"
        subtitle="Temukan profesi kerja yang sesuai dengan dirimu melalui tes minat dan bakat. Jawab soal sederhana dan dapatkan rekomendasi karier yang cocok untukmu!"
        back-route="siswa.dashboard"
    />

    <x-siswa.info-siswa :siswa="$siswa" />

    <div class="max-w-6xl mx-auto py-16 px-6">
        <h2 class="text-3xl sm:text-4xl font-bold text-slate-navy text-center mb-8">
            🚀 Karier Impianmu Sudah Menunggu!
        </h2>
        <p class="text-center text-cool-gray max-w-2xl mx-auto mb-12">
            Tiga profesi terbaik yang paling cocok dengan minat, bakat, dan skill-mu sudah ditemukan.
        </p>

        {{-- 🔹 3 Profesi Tertinggi --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @foreach($topProfesi as $profesi)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col">
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-briefcase text-5xl text-gray-400"></i>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="font-bold text-lg text-slate-navy mb-1">
                            {{ strtoupper($profesi->profesiKerja->nama_profesi_kerja) }}
                        </h3>
                        <p class="text-sm text-cool-gray mb-2">Profesi Kerja</p>
                        <p class="text-sm font-semibold text-slate-navy mb-4">
                            Total Poin: {{ $profesi->total_poin }}
                        </p>
                        <a href="{{ route('siswa.eksplorasi-profesi.show', $profesi->profesiKerja->id) }}"
                            class="mt-auto inline-block px-6 py-2 bg-gray-100 text-slate-navy rounded-lg hover:bg-slate-navy hover:text-white transition">
                            Lihat Detail
                        </a>
                    </div>
                    <div class="p-4 border-t text-sm text-cool-gray italic">
                        karena: {{ $alasanFormatted[$profesi->profesi_kerja_id] ?? '' }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
