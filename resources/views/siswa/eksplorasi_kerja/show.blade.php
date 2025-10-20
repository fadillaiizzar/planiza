@extends('layouts.siswa')

@section('title', 'Detail ' . $profesi->nama_profesi_kerja)

@section('content')
<div class="min-h-screen bg-off-white mb-14">
    <div class="mx-auto px-4 py-6 sm:px-6 lg:px-8">

        <x-siswa.section-header
            title="Detail {{ $profesi->nama_profesi_kerja }}"
            subtitle="Detail profesi kerja, skill dibutuhkan, jurusan, dan industri terkait"
            back-route="siswa.eksplorasi-profesi.index"
        />

        <x-siswa.info-siswa :siswa="$siswa" />

        {{-- Hero Banner dengan Gradient Overlay --}}
        <div class="relative w-full h-80 sm:h-96 rounded-3xl overflow-hidden mb-8 shadow-xl group">
            @if($profesi->gambar)
                <img src="{{ asset('storage/' . $profesi->gambar) }}"
                     alt="{{ $profesi->nama_profesi_kerja }}"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-navy to-cool-gray">
                    <i class="fas fa-briefcase text-6xl text-off-white opacity-40"></i>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-slate-navy/80 via-slate-navy/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-off-white mb-2">
                    {{ $profesi->nama_profesi_kerja }}
                </h1>
                <p class="text-off-white/90 text-sm sm:text-base">Eksplorasi karir masa depanmu</p>
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

            {{-- Deskripsi Profesi - Full Width on Mobile, 2 cols on Desktop --}}
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg p-6 sm:p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-slate-navy/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-align-left text-slate-navy text-sm"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-navy text-xl mb-1">Penjelasan Profesi</h4>
                        <div class="w-16 h-1 bg-slate-navy rounded-full"></div>
                    </div>
                </div>
                <p class="text-cool-gray leading-relaxed">{{ $profesi->deskripsi ?? 'Belum ada deskripsi untuk profesi ini.' }}</p>
            </div>

            {{-- Jurusan Terkait --}}
            <div class="bg-white rounded-3xl shadow-lg p-6 sm:p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-slate-navy/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-star text-slate-navy text-sm"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-navy text-xl mb-1">Jurusan Terkait</h4>
                        <div class="w-16 h-1 bg-slate-navy rounded-full"></div>
                    </div>
                </div>
                <p class="text-cool-gray leading-relaxed">{{ $profesi->info_jurusan ?? 'Informasi skill sedang diperbarui.' }}</p>
            </div>

        </div>

        {{-- Secondary Info Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            {{-- Skill Dibutuhkan --}}
            <div class="bg-white rounded-3xl shadow-lg p-6 sm:p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-slate-navy/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-graduation-cap text-slate-navy text-sm"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-navy text-xl mb-1">Skill Dibutuhkan</h4>
                        <div class="w-16 h-1 bg-slate-navy rounded-full"></div>
                    </div>
                </div>
                <p class="text-cool-gray leading-relaxed">{{ $profesi->info_skill ?? 'Informasi jurusan sedang diperbarui.' }}</p>
            </div>

            {{-- Motivasi Card with Accent --}}
            <div class="relative bg-gradient-to-br from-slate-navy to-slate-navy/90 rounded-3xl shadow-lg p-6 sm:p-8 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-off-white/5 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-off-white/5 rounded-full -ml-12 -mb-12"></div>
                <div class="relative z-10">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-off-white/10 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-lightbulb text-off-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-off-white text-xl mb-1">Motivasi & Tips Karier</h4>
                            <div class="w-16 h-1 bg-off-white rounded-full"></div>
                        </div>
                    </div>
                    <p class="text-off-white/90 leading-relaxed">
                        Jangan lupa terus belajar dan eksplorasi skill yang relevan dengan profesi ini agar siap menghadapi dunia kerja.
                    </p>
                </div>
            </div>

        </div>

        {{-- Industri Terkait Section --}}
        <div class="mt-12">
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-full bg-slate-navy/10 flex items-center justify-center">
                        <i class="fas fa-industry text-slate-navy text-sm"></i>
                    </div>
                    <h4 class="font-bold text-slate-navy text-xl">Industri Terkait</h4>
                </div>
                <p class="text-cool-gray ml-13">Perusahaan dan industri yang membutuhkan profesi ini</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($profesi->industriProfesis as $relasi)
                @php $industri = $relasi->industri; @endphp
                    <div class="group bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative w-full h-48 bg-gradient-to-br from-slate-navy/5 to-cool-gray/5 overflow-hidden">
                            @if($industri->gambar)
                                <img src="{{ asset('storage/' . $industri->gambar) }}"
                                     alt="{{ $industri->nama_industri }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-industry text-4xl text-cool-gray/30"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="p-6">
                            <h3 class="font-bold text-slate-navy text-lg mb-3 line-clamp-2 min-h-14">
                                {{ $industri->nama_industri }}
                            </h3>

                            <div class="flex items-start gap-2 mb-4">
                                <i class="fas fa-map-marker-alt text-cool-gray text-sm mt-1 flex-shrink-0"></i>
                                <p class="text-cool-gray text-sm line-clamp-2">
                                    {{ $industri->alamat ?? 'Alamat tidak tersedia' }}
                                </p>
                            </div>

                            <div class="flex items-start gap-2 mb-4">
                                <i class="fas fa-money-bill-wave text-cool-gray text-sm mt-1 flex-shrink-0"></i>
                                <p class="text-cool-gray text-sm line-clamp-2">
                                    <span>Gaji : </span>
                                    {{ $relasi->gaji ? 'Rp' . number_format($relasi->gaji, 0, ',', '.') : 'Belum tersedia' }}
                                </p>
                            </div>

                            <a href="{{ $industri->website ?? '#' }}"
                               target="_blank"
                               class="block text-center bg-slate-navy text-off-white px-4 py-3 rounded-2xl transition-all duration-300 hover:bg-slate-navy/90 hover:shadow-lg font-medium group-hover:bg-slate-navy/95">
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
                                <i class="fas fa-industry text-3xl text-cool-gray/30"></i>
                            </div>
                            <p class="text-cool-gray text-lg">Belum ada industri terkait untuk profesi ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
