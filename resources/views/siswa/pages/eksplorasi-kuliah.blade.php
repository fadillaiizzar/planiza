@extends('layouts.siswa')

@section('title', 'Eksplorasi Kuliah - Siswa')

@section('content')
    <div class="px-4 py-8 sm:px-8">
        <x-siswa.section-header
            title="Eksplorasi Jurusan Kuliah"
            subtitle="Temukan jurusan kuliah sesuai minat dan jurusan SMK kamu. Lihat prospek karier dan kampus yang menyediakan jurusan impianmu."
            back-route="siswa.dashboard"
        />

        <x-siswa.info-siswa :siswa="$siswa" />

        <x-siswa.search-bar id="search" placeholder="Cari jurusan kuliah..." />

        {{-- Loop setiap kategori jurusan (misal: SIJA, TKR, DKV) --}}
        @foreach ($jurusans  as $jurusan)
            <div class="mb-10">
                <h2 class="text-xl font-bold text-slate-700 mb-4">
                    {{ $jurusanNames[$jurusan] ?? $jurusan }}
                </h2>

                {{-- Grid Jurusan Kuliah per Kategori --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($jurusanKuliahs[$jurusan] ?? [] as $jurusanKuliah)
                        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
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

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $jurusans->links() }}
            <x-paginate :jurusans="$jurusans" />
        </div>
    </div>
@endsection
