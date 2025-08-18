@extends('layouts.siswa')

@section('title', $materi->nama_materi)

@section('content')
<div class="px-4 py-8 sm:px-8">

    {{-- Breadcrumb & Back --}}
    <div class="mb-6 pt-14">
        <div class="flex items-center space-x-3 mb-2">
            <a href="{{ route('siswa.materi') }}" class="text-slate-600 hover:underline text-lg">&lt;</a>
            <h1 class="text-2xl font-bold text-slate-800">Detail Materi</h1>
        </div>
        <p class="text-slate-600">
            Semua materi belajar yang kamu butuhkan, tersusun rapi berdasarkan kelas, jurusan, dan rencana
        </p>
    </div>

    {{-- Info Siswa --}}
    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-700 mb-6">
        <div class="flex items-center space-x-2">
            <i class="fas fa-graduation-cap text-blue-500"></i>
            <span>{{ $materi->topikMateri->kelas->nama_kelas ?? '-' }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-chalkboard-teacher text-green-500"></i>
            <span>{{ $materi->topikMateri->jurusan->nama_jurusan ?? '-' }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-rocket text-purple-500"></i>
            <span>{{ $materi->topikMateri->rencana->nama_rencana ?? '-' }}</span>
        </div>
    </div>

    {{-- Info Topik & Materi --}}
    <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
        {{-- Topik --}}
        <div class="flex flex-col items-center bg-off-white border border-border-gray rounded-lg p-4 shadow-sm">
            <i class="fas fa-book-open text-2xl text-slate-navy mb-1"></i>
            <span class="text-slate-navy font-semibold">{{ $materi->topikMateri->judul_topik ?? '-' }}</span>
        </div>

        {{-- Materi --}}
        <div class="flex flex-col items-center bg-off-white border border-border-gray rounded-lg p-4 shadow-sm">
            <i class="fas fa-file-alt text-2xl text-slate-navy mb-1"></i>
            <span class="text-slate-navy font-semibold">{{ $materi->nama_materi ?? '-' }}</span>
        </div>
    </div>

    {{-- Konten Materi & Preview --}}
    <div class="bg-off-white border border-border-gray rounded-2xl p-6 shadow-md mb-6">
        <h2 class="text-lg font-semibold text-slate-navy mb-4">Preview Materi</h2>

        @php
            $filePath = $materi->file_materi ? asset('storage/' . $materi->file_materi) : null;
        @endphp

        @if($filePath)
            <div class="mb-4">
                @if($materi->tipe_file === 'pdf')
                    <embed src="{{ $filePath }}" type="application/pdf" class="w-full h-96 rounded-lg border border-border-gray shadow-inner">
                @elseif($materi->tipe_file === 'img')
                    <img src="{{ $filePath }}" class="w-full rounded-lg border border-border-gray shadow-inner">
                @elseif($materi->tipe_file === 'video')
                    <video controls class="w-full rounded-lg border border-border-gray shadow-inner">
                        <source src="{{ $filePath }}" type="video/mp4">
                    </video>
                @endif
            </div>

            <div class="flex gap-3">
                <a href="{{ $filePath }}" download
                   class="px-4 py-2 bg-slate-navy text-off-white rounded-lg shadow hover:bg-cool-gray transition">
                    Unduh
                </a>
                <a href="{{ $filePath }}" target="_blank"
                   class="px-4 py-2 bg-off-white border border-slate-navy text-slate-navy rounded-lg shadow hover:bg-slate-navy hover:text-off-white transition">
                    Lihat File
                </a>
            </div>
        @else
            <p class="text-red-500">File materi tidak tersedia.</p>
        @endif
    </div>

    {{-- Deskripsi Materi --}}
    <div class="bg-off-white border border-border-gray rounded-2xl p-6 shadow-sm mb-8">
        <h2 class="text-lg font-semibold text-slate-navy mb-2">Deskripsi Materi</h2>
        <p class="text-cool-gray">{{ $materi->deskripsi_materi }}</p>
    </div>

</div>
@endsection
