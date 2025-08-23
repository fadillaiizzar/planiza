@extends('layouts.siswa')

@section('title', 'Materi')

@section('content')
    <div class="px-4 py-8 sm:px-8">
        <x-siswa.section-header
            title="Temukan Materi"
            subtitle="Semua materi belajar yang kamu butuhkan, tersusun rapi berdasarkan kelas, jurusan, dan rencana"
            back-route="siswa.dashboard"
        />

        <x-siswa.info-siswa
            :siswa="$siswa"
        />

        <x-siswa.search-bar
            id="search" placeholder="Cari materi favoritmu..."
        />

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @forelse($topikMateris as $item)
                @php
                    $slug = strtolower(str_replace(' ', '-', $item->judul_topik));
                    $icons = ['fa-book', 'fa-lightbulb', 'fa-pencil-alt', 'fa-graduation-cap', 'fa-flask'];
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
                    <div id="{{ $slug }}" class="hidden mt-4 w-full text-left bg-white text-slate-800 rounded-lg p-3 shadow-inner max-h-48 overflow-y-auto scrollbar-thin scrollbar-thumb-indigo-300 scrollbar-track-gray-100">
                       <ul class="space-y-2">
                            @foreach($item->materis ?? [] as $sub)
                                @php
                                    $icon = $icons[array_rand($icons)];
                                @endphp
                                <li class="flex items-center gap-2">
                                    <i class="fas {{ $icon }} text-indigo-400"></i>
                                    <a href="{{ route('siswa.materi.show', $sub->id) }}" class="hover:text-indigo-600 font-medium transition">
                                        {{ $sub->nama_materi }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            @empty
                <x-siswa.empty-state
                    title="Belum Ada Topik Tersedia"
                    message="Tenang aja, materi akan segera ditambahkan. Sementara itu, kamu bisa eksplorasi bagian lain dulu"
                />
            @endforelse
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
