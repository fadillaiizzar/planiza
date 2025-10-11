@extends('layouts.siswa')

@section('title', 'Detail ' . $jurusanKuliah->nama_jurusan_kuliah)

@section('content')
<div class="min-h-screen bg-off-white mb-14">
    <div class="mx-auto px-4 py-6 sm:px-6 lg:px-8">

        {{-- Header --}}
        <x-siswa.section-header
            title="Detail {{ $jurusanKuliah->nama_jurusan_kuliah }}"
            subtitle="Informasi lengkap jurusan kuliah, prospek karier, dan kampus penyelenggara"
            back-route="siswa.eksplorasi-jurusan.index"
        />

        <x-siswa.info-siswa :siswa="$siswa" />

        {{-- Hero Banner --}}
        <div class="relative w-full h-80 sm:h-96 rounded-3xl overflow-hidden mb-8 shadow-xl group">
            @if($jurusanKuliah->gambar)
                <img src="{{ asset('storage/' . $jurusanKuliah->gambar) }}"
                     alt="{{ $jurusanKuliah->nama_jurusan_kuliah }}"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-navy to-cool-gray">
                    <i class="fas fa-graduation-cap text-6xl text-off-white opacity-40"></i>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-slate-navy/80 via-slate-navy/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-off-white mb-2">
                    {{ $jurusanKuliah->nama_jurusan_kuliah }}
                </h1>
                <p class="text-off-white/90 text-sm sm:text-base">Jelajahi dunia perkuliahan dan peluang masa depanmu</p>
            </div>
        </div>

        {{-- Main Info Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

            {{-- Deskripsi Jurusan --}}
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg p-6 sm:p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-slate-navy/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-align-left text-slate-navy text-sm"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-navy text-xl mb-1">Tentang Jurusan</h4>
                        <div class="w-16 h-1 bg-slate-navy rounded-full"></div>
                    </div>
                </div>
                <p class="text-cool-gray leading-relaxed">{{ $jurusanKuliah->deskripsi ?? 'Belum ada deskripsi untuk jurusan ini.' }}</p>
            </div>

            {{-- Prospek Karier --}}
            <div class="bg-white rounded-3xl shadow-lg p-6 sm:p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-slate-navy/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-briefcase text-slate-navy text-sm"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-navy text-xl mb-1">Prospek Karier</h4>
                        <div class="w-16 h-1 bg-slate-navy rounded-full"></div>
                    </div>
                </div>
                <p class="text-cool-gray leading-relaxed">{{ $jurusanKuliah->info_prospek ?? 'Prospek karier sedang diperbarui.' }}</p>
            </div>

        </div>

        {{-- Info Tambahan --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            {{-- Keahlian Utama --}}
            <div class="bg-white rounded-3xl shadow-lg p-6 sm:p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-slate-navy/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-tools text-slate-navy text-sm"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-navy text-xl mb-1">Mata Kuliah yang Dipelajari</h4>
                        <div class="w-16 h-1 bg-slate-navy rounded-full"></div>
                    </div>
                </div>
                <p class="text-cool-gray leading-relaxed">{{ $jurusanKuliah->info_matkul ?? 'Informasi mata kuliah sedang diperbarui.' }}</p>
            </div>

            {{-- Motivasi --}}
            <div class="relative bg-gradient-to-br from-slate-navy to-slate-navy/90 rounded-3xl shadow-lg p-6 sm:p-8 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-off-white/5 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-off-white/5 rounded-full -ml-12 -mb-12"></div>
                <div class="relative z-10">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-off-white/10 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-lightbulb text-off-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-off-white text-xl mb-1">Motivasi Kuliah</h4>
                            <div class="w-16 h-1 bg-off-white rounded-full"></div>
                        </div>
                    </div>
                    <p class="text-off-white/90 leading-relaxed">
                        Tetap semangat menempuh pendidikan dan kembangkan passion kamu di bidang ini agar siap bersaing di dunia kerja.
                    </p>
                </div>
            </div>

        </div>

        {{-- Kampus yang Menyediakan Jurusan Ini --}}
        <div class="mt-12">
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-full bg-slate-navy/10 flex items-center justify-center">
                        <i class="fas fa-university text-slate-navy text-sm"></i>
                    </div>
                    <h4 class="font-bold text-slate-navy text-xl">Kampus yang Menyediakan Jurusan Ini</h4>
                </div>
                <p class="text-cool-gray ml-13">Daftar universitas atau politeknik yang membuka jurusan {{ $jurusanKuliah->nama_jurusan_kuliah }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($jurusanKuliah->kampusJurusans as $relasi)
                    @php $kampus = $relasi->kampus; @endphp
                    <div class="group bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative w-full h-48 bg-gradient-to-br from-slate-navy/5 to-cool-gray/5 overflow-hidden">
                            @if($kampus->gambar)
                                <img src="{{ asset('storage/' . $kampus->gambar) }}"
                                     alt="{{ $kampus->nama_kampus }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-university text-4xl text-cool-gray/30"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="p-6">
                            <h3 class="font-bold text-slate-navy text-lg mb-3 line-clamp-2 min-h-14">
                                {{ $kampus->nama_kampus }}
                            </h3>
                            <div class="flex items-start gap-2 mb-4">
                                <i class="fas fa-map-marker-alt text-cool-gray text-sm mt-1 flex-shrink-0"></i>
                                <p class="text-cool-gray text-sm line-clamp-2">
                                    {{ $kampus->alamat ?? 'Alamat tidak tersedia' }}
                                </p>
                            </div>
                            <a href="{{ $kampus->website ?? '#' }}" target="_blank"
                               class="block text-center bg-slate-navy text-off-white px-4 py-3 rounded-2xl transition-all duration-300 hover:bg-slate-navy/90 hover:shadow-lg font-medium">
                                <span class="flex items-center justify-center gap-2">
                                    Kunjungi Website
                                    <i class="fas fa-external-link-alt text-xs"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-3xl shadow-lg p-12 text-center">
                            <div class="w-20 h-20 rounded-full bg-slate-navy/5 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-university text-3xl text-cool-gray/30"></i>
                            </div>
                            <p class="text-cool-gray text-lg">Belum ada kampus yang menyediakan jurusan ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
