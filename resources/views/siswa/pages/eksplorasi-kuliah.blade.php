@extends('layouts.siswa')

@section('title', 'Eksplorasi Jurusan - Siswa')

@section('content')
    <div class="px-4 py-8 sm:px-8">
        <x-siswa.section-header
            title="Eksplorasi Jurusan Kuliah"
            subtitle="Temukan jurusan kuliah sesuai minat dan jurusan SMK kamu. Lihat prospek karier dan kampus yang menyediakan jurusan impianmu."
            back-route="siswa.dashboard"
        />

        <x-siswa.info-siswa :siswa="$siswa" />

        <x-siswa.search-bar
            id="search-jurusan"
            placeholder="Cari jurusan favoritmu..."
            :includeSmk="true"
        />

        @foreach ($jurusans  as $jurusan)
            <div class="jurusan-smk-group mb-10">
                <h2 class="text-xl font-bold text-slate-700 mb-4">
                    {{ $jurusanNames[$jurusan] ?? $jurusan }}
                </h2>

                {{-- Grid Jurusan Kuliah per Kategori --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-search-container="search-jurusan">
                    @forelse ($jurusanKuliahs[$jurusan] ?? [] as $jurusanKuliah)
                        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden" data-search-item="{{ $jurusanKuliah->nama_jurusan_kuliah }}" data-search-smk="{{ $jurusanNames[$jurusan] ?? '' }}">
                            <div class="w-full h-40 bg-gray-200 overflow-hidden">
                                @if ($jurusanKuliah->gambar)
                                    <img src="{{ asset('storage/' . $jurusanKuliah->gambar) }}"
                                        alt="{{ $jurusanKuliah->nama_jurusan_kuliah }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-graduation-cap text-3xl"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="w-full px-4 py-7 flex flex-col gap-4">
                                <h3 class="font-semibold text-slate-navy text-left text-lg">
                                    {{ $jurusanKuliah->nama_jurusan_kuliah }}
                                </h3>

                                <div class="flex gap-3 justify-start w-full">
                                    <a href="{{ route('siswa.eksplorasi-jurusan.show', $jurusanKuliah->id) }}"
                                        class="flex-1 text-sm text-center bg-slate-navy text-white px-4 py-2 rounded-lg transition">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <x-siswa.empty-state
                            title="Belum Ada Jurusan Kuliah"
                            message="Tenang aja, jurusan kuliah akan segera ditambahkan."
                        />
                    @endforelse
                </div>
            </div>
        @endforeach

        <div class="mt-8">
            {{ $jurusans->links() }}
            <x-paginate :items="$jurusans" />
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('siswa.eksplorasi-profesi.index') }}"
               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold text-lg transition-all duration-300 hover:gap-3 group">
                <span class="relative">
                    Lihat Eksplorasi Profesi
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                </span>
                <svg class="w-5 h-5 transform transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
@endsection
