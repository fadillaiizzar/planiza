@extends('layouts.siswa')

@section('title', 'Detail ' . $profesi->nama_profesi_kerja)

@section('content')
<div class="px-4 py-8 sm:px-8">

    <x-siswa.section-header
        title="Detail {{ $profesi->nama_profesi_kerja }}"
        subtitle="Detail profesi kerja, skill dibutuhkan, jurusan, dan industri terkait"
        back-route="siswa.eksplorasi-profesi.index"
    />

    <x-siswa.info-siswa
        :siswa="$siswa"
    />

    {{-- Banner Gambar Profesi --}}
    <div class="w-full h-64 rounded-2xl overflow-hidden mb-6">
        @if($profesi->gambar)
            <img src="{{ asset('storage/' . $profesi->gambar) }}" alt="{{ $profesi->nama_profesi_kerja }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center bg-cool-gray text-white text-3xl">
                <i class="fas fa-briefcase"></i>
            </div>
        @endif
    </div>

    {{-- 3 Box Sejajar --}}
    <div class="flex flex-wrap gap-6 mb-6">
        {{-- Skill --}}
        <div class="flex-1 bg-white rounded-2xl shadow p-4">
            <h4 class="font-semibold text-slate-navy mb-2">Skill Dibutuhkan</h4>
            <p class="text-sm text-cool-gray">{{ $profesi->info_skill ?? '-' }}</p>
        </div>

        {{-- Deskripsi --}}
        <div class="flex-[2] bg-white rounded-2xl shadow p-4">
            <h4 class="font-semibold text-slate-navy mb-2">Penjelasan Profesi</h4>
            <p class="text-sm text-cool-gray">{{ $profesi->deskripsi ?? '-' }}</p>
        </div>

        {{-- Jurusan --}}
        <div class="flex-1 bg-white rounded-2xl shadow p-4">
            <h4 class="font-semibold text-slate-navy mb-2">Jurusan Terkait</h4>
            <p class="text-sm text-cool-gray">{{ $profesi->info_jurusan ?? '-' }}</p>
        </div>
    </div>

    {{-- Box Motivasi / Unik --}}
    <div class="bg-blue-50 rounded-2xl shadow p-6 mb-6">
        <h4 class="font-semibold text-slate-navy mb-2">Motivasi / Tips Karier</h4>
        <p class="text-sm text-cool-gray">Jangan lupa terus belajar dan eksplorasi skill yang relevan dengan profesi ini agar siap menghadapi dunia kerja.</p>
    </div>

   {{-- Industri Terkait --}}
    <div class="mt-6">
        <h4 class="font-semibold text-slate-navy mb-4">Industri Terkait</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($profesi->industris as $industri)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                    {{-- Gambar Industri --}}
                    <div class="w-full h-40 bg-gray-200 overflow-hidden">
                        @if($industri->gambar)
                            <img src="{{ asset('storage/' . $industri->gambar) }}" alt="{{ $industri->nama_industri }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-cool-gray">
                                <i class="fas fa-industry text-3xl"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Nama dan Info --}}
                    <div class="w-full px-4 py-7 flex flex-col">
                        <h3 class="font-semibold text-slate-navy text-left text-lg mb-1">{{ $industri->nama_industri }}</h3>

                        <p class="text-cool-gray mb-4">Alamat : <span>{{ $industri->alamat ?? '-' }}</span></p>

                        <a href="{{ $industri->website ?? '#' }}" target="_blank"
                            class="flex-1 text-sm text-center bg-slate-navy text-white px-4 py-2 rounded-lg transition">
                            Kunjungi Website
                        </a>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">Belum ada industri terkait.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
