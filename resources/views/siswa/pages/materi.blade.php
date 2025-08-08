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
        <div class="flex items-center space-x-2">
            <i class="fas fa-graduation-cap text-blue-500"></i>
            <span>XI RPL 2</span>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-chalkboard-teacher text-green-500"></i>
            <span>Rekayasa Perangkat Lunak</span>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-rocket text-purple-500"></i>
            <span>Rencana Belajar Semester Ganjil</span>
        </div>
    </div>

    {{-- Search Bar --}}
    <div class="mb-6">
        <input type="text" id="search" placeholder="🔍 Cari mata pelajaran atau materi"
            class="w-full sm:w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    {{-- Topik Materi Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

        @php
            $materi = [
                [
                    'id' => 'materi-1',
                    'judul' => 'Pemrograman Web',
                    'jumlah' => 5,
                    'daftar' => ['HTML Dasar', 'CSS Layout', 'Javascript DOM', 'Laravel Dasar', 'Blade Template']
                ],
                [
                    'id' => 'materi-2',
                    'judul' => 'Jaringan Komputer',
                    'jumlah' => 3,
                    'daftar' => ['Topologi Jaringan', 'IP Addressing', 'Subnetting']
                ],
                [
                    'id' => 'materi-3',
                    'judul' => 'Basis Data',
                    'jumlah' => 4,
                    'daftar' => ['SQL Dasar', 'Relasi Tabel', 'Query Select', 'Normalisasi']
                ],
                [
                    'id' => 'materi-4',
                    'judul' => 'Pemrograman Mobile',
                    'jumlah' => 3,
                    'daftar' => ['Android Studio Dasar', 'Layout XML', 'Firebase CRUD']
                ],
                [
                    'id' => 'materi-5',
                    'judul' => 'Desain UI/UX',
                    'jumlah' => 3,
                    'daftar' => ['Figma Dasar', 'Wireframe vs Prototype', 'Design System']
                ],
                [
                    'id' => 'materi-6',
                    'judul' => 'Internet of Things (IoT)',
                    'jumlah' => 4,
                    'daftar' => ['Mikrokontroler ESP8266', 'Sensor DHT11', 'Adafruit IO', 'Blynk App']
                ],
                [
                    'id' => 'materi-7',
                    'judul' => 'Keamanan Jaringan',
                    'jumlah' => 3,
                    'daftar' => ['Firewall', 'Enkripsi Data', 'Ethical Hacking Dasar']
                ],
            ];
        @endphp

        @foreach($materi as $item)
        <div class="bg-white shadow-md rounded-lg p-4 text-center relative h-full">
            <div class="text-2xl mb-2 text-blue-600">
                <i class="fas fa-book-open"></i>
            </div>
            <h2 class="text-lg font-semibold mb-1">{{ $item['judul'] }}</h2>
            <p class="text-sm text-slate-600 mb-2">{{ $item['jumlah'] }} Materi</p>
            <button onclick="toggleMateri('{{ $item['id'] }}', this)" class="text-blue-500 text-sm">
                <i class="fas fa-chevron-down"></i>
            </button>
            <div id="{{ $item['id'] }}" class="hidden mt-4 text-left">
                <ul class="text-sm list-disc list-inside space-y-1">
                    @foreach($item['daftar'] as $materi)
                        <li>{{ $materi }}</li>
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
