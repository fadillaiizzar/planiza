@extends('layouts.siswa')

@section('title', $materi->nama_materi)

@section('content')
<div class="px-4 py-8 sm:px-8">

    {{-- Breadcrumb & Back --}}
    <div class="mb-6 pt-14">
        <div class="flex items-center space-x-3 mb-2">
            <a href="{{ route('siswa.materi.index') }}" class="text-slate-600 hover:underline text-lg">&lt;</a>
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
        <div class="flex flex-col items-center justify-center bg-off-white border border-border-gray rounded-lg px-4 py-4 md:py-6 shadow-sm">
            <div class="flex justify-center gap-3">
                <i class="fas fa-book-open text-2xl text-slate-navy mb-1"></i>
                <p class="text-slate-navy font-semibold">Topik Materi : <span class="text-slate-navy font-semibold">{{ $materi->topikMateri->judul_topik ?? '-' }}</span></p>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center bg-off-white border border-border-gray rounded-lg px-4 py-4 md:py-6 shadow-sm">
            <div class="flex justify-center gap-3">
                <i class="fas fa-file-alt text-2xl text-slate-navy mb-1"></i>
                <p class="text-slate-navy font-semibold">Materi : <span class="text-slate-navy font-semibold">{{ $materi->nama_materi ?? '-' }}</span></p>
            </div>
        </div>
    </div>

    {{-- Konten Materi & Preview --}}
    <div class="bg-off-white border border-border-gray rounded-2xl p-6 shadow-md mb-6">
        <h2 class="text-lg font-semibold text-slate-navy mb-4">Preview Materi</h2>

        @php
            $files = $materi->file_materi ? json_decode($materi->file_materi, true) : [];
        @endphp

        @if(count($files) > 0)
            @foreach($files as $file)
                @php $filePath = asset('storage/' . $file); @endphp

                <div class="mb-6 text-center">
                    @if($materi->tipe_file === 'pdf')
                        <div class="mx-auto max-w-2xl h-[400px] rounded-xl border border-slate-300 bg-white shadow-md overflow-hidden">
                            <embed src="{{ $filePath }}" type="application/pdf" class="w-full h-full">
                        </div>
                    @elseif($materi->tipe_file === 'img')
                        <div class="mx-auto max-w-2xl rounded-xl border border-slate-300 bg-white shadow-md overflow-hidden">
                            <img src="{{ $filePath }}"
                                class="w-full object-contain max-h-[400px] mx-auto">
                        </div>
                    @elseif($materi->tipe_file === 'video')
                        <div class="mx-auto max-w-2xl rounded-xl border border-slate-300 bg-black shadow-md overflow-hidden">
                            <video controls class="w-full max-h-[400px] mx-auto">
                                <source src="{{ $filePath }}" type="video/mp4">
                            </video>
                        </div>
                    @endif

                    {{-- Tombol Aksi --}}
                    <div class="flex gap-4 mt-5 justify-center">
                        <a href="{{ $filePath }}" download
                        class="px-6 py-2 bg-slate-navy text-white rounded-lg shadow hover:bg-cool-gray transition">
                            Unduh
                        </a>
                        <a href="{{ $filePath }}" target="_blank"
                        class="px-6 py-2 bg-white border border-slate-navy text-slate-navy rounded-lg shadow hover:bg-slate-navy hover:text-white transition">
                            Lihat File
                        </a>
                    </div>
                </div>


            @endforeach
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
