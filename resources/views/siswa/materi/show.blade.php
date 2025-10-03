@extends('layouts.siswa')

@section('title', 'Detail ' . $materi->nama_materi)

@section('content')
<div class="min-h-screen bg-off-white mb-14">
    <div class="mx-auto px-4 py-6 sm:px-6 lg:px-8">

        <x-siswa.section-header
            title="Detail {{ $materi->nama_materi }}"
            subtitle="Semua materi belajar yang kamu butuhkan, tersusun rapi berdasarkan kelas, jurusan, dan rencana"
            back-route="siswa.materi.index"
        />

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

        {{-- Hero Info Cards --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            {{-- Topik Materi Card --}}
            <div class="bg-gradient-to-br from-slate-navy to-slate-navy/90 rounded-3xl shadow-xl p-6 sm:px-6 sm:py-5 hover:shadow-2xl transition-shadow duration-300 border-2 border-slate-navy/10">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-off-white/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-file-alt text-off-white text-xl"></i>
                    </div>
                    <div>
                        <p class="text-off-white/70 text-sm mb-1">Topik Materi</p>
                        <h3 class="text-off-white font-bold text-xl">{{ $materi->topikMateri->judul_topik ?? '-' }}</h3>
                    </div>
                </div>
            </div>

            {{-- Nama Materi Card --}}
            <div class="bg-white rounded-3xl shadow-xl p-6 sm:px-6 sm:py-5 hover:shadow-2xl transition-shadow duration-300 border-2 border-slate-navy/10">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-navy/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-file-alt text-slate-navy text-xl"></i>
                    </div>
                    <div>
                        <p class="text-cool-gray text-sm mb-1">Nama Materi</p>
                        <h3 class="text-slate-navy font-bold text-xl">{{ $materi->nama_materi ?? '-' }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Preview Materi Section --}}
        <div class="bg-white rounded-3xl shadow-xl p-6 sm:p-8 mb-8 hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-slate-navy/10 flex items-center justify-center">
                    <i class="fas fa-eye text-slate-navy text-sm"></i>
                </div>
                <div>
                    <h2 class="font-bold text-slate-navy text-xl mb-1">Preview Materi</h2>
                    <div class="w-16 h-1 bg-slate-navy rounded-full"></div>
                </div>
            </div>

            @php
                $files = $materi->file_materi ? json_decode($materi->file_materi, true) : [];
            @endphp

            @if(count($files) > 0)
                @foreach($files as $file)
                    @php $filePath = asset('storage/' . $file); @endphp

                    <div class="mb-6">
                        {{-- Preview Container --}}
                        <div class="relative rounded-3xl overflow-hidden bg-slate-navy/5 border-2 border-border-gray mb-6">
                            @if($materi->tipe_file === 'pdf')
                                <div class="w-full h-[500px] lg:h-[600px]">
                                    <embed src="{{ $filePath }}" type="application/pdf" class="w-full h-full">
                                </div>
                            @elseif($materi->tipe_file === 'img')
                                <div class="w-full bg-white p-4">
                                    <img src="{{ $filePath }}"
                                        alt="Preview Materi"
                                        class="w-full h-auto max-h-[600px] object-contain mx-auto rounded-2xl">
                                </div>
                            @elseif($materi->tipe_file === 'video')
                                <div class="w-full bg-slate-navy/90">
                                    <video controls class="w-full max-h-[600px] mx-auto">
                                        <source src="{{ $filePath }}" type="video/mp4">
                                    </video>
                                </div>
                            @endif
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ $filePath }}" download
                               class="group flex items-center justify-center gap-3 px-8 py-4 bg-slate-navy text-off-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5 font-semibold">
                                <i class="fas fa-download group-hover:animate-bounce"></i>
                                <span>Unduh Materi</span>
                            </a>
                            <a href="{{ $filePath }}" target="_blank"
                               class="group flex items-center justify-center gap-3 px-8 py-4 bg-white border-2 border-slate-navy text-slate-navy rounded-2xl shadow-lg hover:shadow-xl hover:bg-slate-navy hover:text-off-white transition-all duration-300 hover:-translate-y-0.5 font-semibold">
                                <i class="fas fa-external-link-alt group-hover:rotate-12 transition-transform"></i>
                                <span>Buka di Tab Baru</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-16">
                    <div class="w-20 h-20 rounded-full bg-slate-navy/5 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-excel text-4xl text-cool-gray/30"></i>
                    </div>
                    <p class="text-cool-gray text-lg font-medium">File materi tidak tersedia</p>
                    <p class="text-cool-gray/70 text-sm mt-2">Materi sedang dalam proses pengunggahan</p>
                </div>
            @endif
        </div>

        {{-- Deskripsi Materi --}}
        <div class="bg-white rounded-3xl shadow-xl p-6 sm:p-8 hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-start gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-slate-navy/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-align-left text-slate-navy text-sm"></i>
                </div>
                <div>
                    <h2 class="font-bold text-slate-navy text-xl mb-1">Deskripsi Materi</h2>
                    <div class="w-16 h-1 bg-slate-navy rounded-full"></div>
                </div>
            </div>
            <div class="prose prose-slate max-w-none">
                <p class="text-cool-gray leading-relaxed text-base">{{ $materi->deskripsi_materi }}</p>
            </div>
        </div>

        {{-- Additional Info Card --}}
        <div class="mt-8 bg-gradient-to-r from-slate-navy/5 to-cool-gray/5 rounded-3xl p-6 border border-border-gray">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-full bg-slate-navy/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-info-circle text-slate-navy text-lg"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-navy text-lg mb-2">Tips Belajar</h3>
                    <p class="text-cool-gray text-sm leading-relaxed">
                        Pelajari materi ini dengan fokus dan catat poin-poin penting. Jangan ragu untuk mengulang kembali bagian yang belum dipahami. Semangat belajar! 🚀
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
