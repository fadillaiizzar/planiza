@extends('layouts.siswa')

@section('title', 'Eksplorasi Profesi - Siswa')

@section('content')
    <div class="px-4 py-8 sm:px-8">
        <x-siswa.section-header
            title="Temukan Eksplorasi Profesi"
            subtitle="Jelajahi berbagai profesi dan jurusan kuliah masa depan sesuai minat dan potensi kamu. Dapatkan informasi singkat tentang setiap jurusan, prospek karier, serta kampus yang menyediakannya"
            back-route="siswa.dashboard"
        />

        <x-siswa.info-siswa
            :siswa="$siswa"
        />

        <x-siswa.search-bar
            id="search" placeholder="Cari profesi favoritmu..."
        />

        {{-- Grid Profesi Kerja --}}
        <div>
            @forelse($profesiKerjas as $jurusan => $profesis)
                <div class="mb-10">
                    <h2 class="text-xl font-bold text-slate-700 mb-4">{{ $jurusanNames[$jurusan] ?? $jurusan }}</h2>

                    {{-- Grid Profesi per Jurusan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($profesis as $profesi)
                            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                                <div class="w-full h-40 bg-gray-200 overflow-hidden">
                                    @if($profesi->gambar)
                                        <img src="{{ asset('storage/' . $profesi->gambar) }}"
                                            alt="{{ $profesi->nama_profesi_kerja }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-cool-gray">
                                            <i class="fas fa-briefcase text-3xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="w-full px-4 py-7 flex flex-col gap-4">
                                    <h3 class="font-semibold text-slate-navy text-left text-lg">
                                        {{ $profesi->nama_profesi_kerja }}
                                    </h3>

                                    <div class="flex gap-3 justify-start w-full">
                                        <p class="flex-1 text-sm text-center border border-border-gray px-4 py-2 rounded-lg transition">
                                            <i class="fas fa-money-bill-wave"></i> Rp{{ number_format($profesi->gaji, 0, ',', '.') }}
                                        </p>

                                        <a href="{{ route('siswa.eksplorasi-profesi.show', $profesi->id) }}"
                                        class="flex-1 text-sm text-center bg-slate-navy text-white px-4 py-2 rounded-lg transition">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <x-siswa.empty-state
                    title="Belum Ada Profesi Kerja Tersedia"
                    message="Tenang aja, profesi kerja akan segera ditambahkan. Sementara itu, kamu bisa eksplorasi bagian lain dulu"
                />
            @endforelse
        </div>
    </div>
@endsection

