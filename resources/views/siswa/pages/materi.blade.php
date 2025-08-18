@extends('layouts.siswa')

@section('title', 'Materi')

@section('content')
<div class="px-4 py-8 sm:px-8">
    {{-- Judul & Deskripsi --}}
    <div class="mb-6 pt-14">
        <div class="flex items-center space-x-3 mb-2">
            <a href="{{ route('siswa.dashboard') }}" class="text-slate-600 hover:underline text-lg">&lt;</a>
            <h1 class="text-2xl font-bold text-slate-800">Temukan Materi</h1>
        </div>
        <p class="text-slate-600">
            Semua materi belajar yang kamu butuhkan, tersusun rapi berdasarkan kelas, jurusan, dan rencana
        </p>
    </div>

    {{-- Info Siswa --}}
    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-700 mb-6">
        @if($siswa)
            <div class="flex items-center space-x-2">
                <i class="fas fa-graduation-cap text-blue-500"></i>
                <span>{{ $siswa->kelas->nama_kelas ?? '-' }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-chalkboard-teacher text-green-500"></i>
                <span>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-rocket text-purple-500"></i>
                <span>{{ $siswa->rencana->nama_rencana ?? '-' }}</span>
            </div>
        @else
            <span>Data siswa tidak ditemukan</span>
        @endif
    </div>

    {{-- Search Bar --}}
    <div class="mb-6">
        <input type="text" id="search" placeholder="🔍 Cari mata pelajaran atau materi"
            class="w-full sm:w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    {{-- Topik Materi Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @foreach($topikMateris as $item)
            @php
                $slug = strtolower(str_replace(' ', '-', $item->judul_topik));
            @endphp
            <div class="relative rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 cursor-pointer bg-off-white border border-border-gray p-5 flex flex-col items-center h-full">
                {{-- Icon --}}
                <div class="text-3xl mb-3 text-slate-navy">
                    <i class="fas fa-book-open"></i>
                </div>

                {{-- Judul Topik --}}
                <h2 class="text-lg font-bold mb-2 line-clamp-2 text-slate-navy text-center">{{ $item->judul_topik }}</h2>

                {{-- Jumlah Materi --}}
                <span class="bg-slate-navy text-off-white font-semibold text-sm px-3 py-1 rounded-full mb-3 shadow">
                    {{ $item->materis->count() ?? 0 }} Materi
                </span>

                {{-- Toggle Materi --}}
                <button onclick="toggleMateri('{{ $slug }}', this)" class="mt-auto inline-flex items-center gap-1 text-slate-navy font-medium hover:text-cool-gray">
                    <i class="fas fa-chevron-down"></i> Lihat Materi
                </button>

                {{-- Daftar Materi --}}
                <div id="{{ $slug }}" class="hidden mt-4 w-full text-left bg-off-white text-slate-navy rounded-lg p-3 shadow-inner max-h-48 overflow-y-auto">
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach($item->materis ?? [] as $sub)
                            <li>
                                <a href="{{ route('siswa.materi.show', $sub->id) }}"
                                class="hover:text-cool-gray font-medium transition">
                                    {{ $sub->nama_materi }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleMateri(id, btn) {
        const allMateri = document.querySelectorAll('[id^="materi-"]');
        const allIcons = document.querySelectorAll('button > i');

        allMateri.forEach(el => {
            if (el.id !== id) {
                el.classList.add('hidden');
            }
        });

        allIcons.forEach(icon => {
            if (btn.querySelector('i') !== icon) {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });

        const el = document.getElementById(id);
        const icon = btn.querySelector('i');
        const isOpen = !el.classList.contains('hidden');

        el.classList.toggle('hidden');

        if (isOpen) {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        } else {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        }
    }
</script>
@endpush
