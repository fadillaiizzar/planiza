@extends('layouts.siswa')

@section('title', 'Materi')

@section('content')
    <div class="px-4 py-8 sm:px-8">
        {{-- Judul & Deskripsi --}}
        <div class="mb-6 pt-14">
            <!-- Flex container untuk icon < dan judul -->
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
            <div class="flex items-center space-x-2">
                <i class="fas fa-graduation-cap text-blue-500"></i>
                <span>{{ auth()->user()->kelas->nama_kelas ?? '-' }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-chalkboard-teacher text-green-500"></i>
                <span>{{ auth()->user()->jurusan->nama_jurusan ?? '-' }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-rocket text-purple-500"></i>
                <span>{{ auth()->user()->rencana->nama_rencana ?? '-' }}</span>
            </div>
        </div>

        {{-- Search Bar --}}
        <div class="mb-6">
            <input type="text" id="search" placeholder="🔍 Cari mata pelajaran atau materi" class="w-full sm:w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        {{-- Topik Materi Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @forelse ($topikMateri as $topik)
                <div class="bg-white shadow-md rounded-lg p-4 text-center relative">
                    <div class="text-2xl mb-2 text-blue-600">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h2 class="text-lg font-semibold mb-1">{{ $topik->judul_topik }}</h2>
                    <p class="text-sm text-slate-600 mb-2">{{ $topik->materis->count() }} Materi</p>

                    <button onclick="toggleMateri('materi-{{ $topik->id }}')" class="text-blue-500 text-sm">
                        <i class="fas fa-chevron-down"></i>
                    </button>

                    {{-- Daftar Materi (toggleable) --}}
                    <div id="materi-{{ $topik->id }}" class="hidden mt-4 text-left">
                        <ul class="text-sm list-disc list-inside space-y-1">
                            @foreach ($topik->materis as $materi)
                                <li>{{ $materi->nama_materi }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500">Belum ada topik materi tersedia.</p>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleMateri(id) {
        const el = document.getElementById(id);
        el.classList.toggle('hidden');
    }
</script>
@endpush
