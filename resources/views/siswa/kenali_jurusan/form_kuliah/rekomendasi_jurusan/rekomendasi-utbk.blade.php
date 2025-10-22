<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-navy mb-3">
            Rekomendasi Berdasarkan Nilai UTBK
        </h2>
        <div class="w-24 h-1 bg-slate-navy mx-auto"></div>
    </div>

    @forelse($rekomUTBK as $jurusanData)
        <div class="mb-20">
            {{-- Header Jurusan --}}
            <div class="bg-gradient-to-r from-slate-navy to-cool-gray rounded-3xl p-8 mb-8 shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold text-off-white mb-2">
                            {{ $jurusanData['jurusan']->nama_jurusan_kuliah }}
                        </h3>
                        <p class="text-off-white/80 text-lg">
                            Nilai UTBK {{ $namaSiswa }} : <span>{{ $nilaiUtbk }}</span>
                        </p>
                    </div>
                    <a href="{{ route('siswa.eksplorasi-jurusan.show', $jurusanData['jurusan']->id) }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-off-white text-slate-navy font-semibold rounded-full hover:bg-off-white/90 transition-all duration-300 shadow-md hover:shadow-xl group w-fit">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>

            @if(count($jurusanData['kampus']) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($jurusanData['kampus'] as $index => $kampusData)
                        <div class="group relative">
                            <div class="bg-white rounded-3xl border border-border-gray hover:border-slate-navy transition-all duration-300 overflow-hidden h-full flex flex-col shadow-sm hover:shadow-xl">

                                {{-- Header Card --}}
                                <div class="relative bg-gradient-to-br from-slate-navy/5 to-cool-gray/5 p-8">
                                    {{-- Status Badge --}}
                                    <div class="absolute top-4 right-4">
                                        <span class="px-4 py-1.5 text-xs font-bold rounded-full shadow-md
                                            {{ $kampusData['status'] == 'Tinggi' ? 'bg-green-500 text-white' : ($kampusData['status']=='Sedang' ? 'bg-yellow-400 text-slate-navy' : 'bg-red-500 text-white') }}">
                                            Peluang {{ $kampusData['status'] }}
                                        </span>
                                    </div>

                                    {{-- Icon --}}
                                    <div class="w-16 h-16 bg-slate-navy rounded-2xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-university text-2xl text-off-white"></i>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="p-6 flex-grow flex flex-col">
                                    <h4 class="font-bold text-xl text-slate-navy mb-4 line-clamp-2">
                                        {{ $kampusData['kampus']->nama_kampus }}
                                    </h4>

                                    {{-- Info Grid --}}
                                    <div class="space-y-3 mb-4">
                                        <div class="flex items-start gap-3">
                                            <div class="w-2 h-2 bg-slate-navy rounded-full mt-2 flex-shrink-0"></div>
                                            <div class="flex-grow">
                                                <p class="text-sm text-cool-gray">Passing Grade</p>
                                                <p class="font-semibold text-slate-navy">{{ $kampusData['passing_grade'] ?? 'Belum tersedia' }}</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-3">
                                            <div class="w-2 h-2 bg-slate-navy rounded-full mt-2 flex-shrink-0"></div>
                                            <div class="flex-grow">
                                                <p class="text-sm text-cool-gray">Pencapaian Nilai</p>
                                                <div class="flex items-center gap-2">
                                                    <div class="flex-grow bg-border-gray rounded-full h-2 overflow-hidden">
                                                        <div class="h-full bg-slate-navy rounded-full transition-all duration-500"
                                                             style="width: {{ min($kampusData['persentase'] ?? 0, 100) }}%"></div>
                                                    </div>
                                                    <span class="font-semibold text-slate-navy text-sm">{{ $kampusData['persentase'] ?? 0 }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-slate-navy/5 rounded-2xl p-4 mb-4">
                                        <p class="text-sm text-cool-gray italic">
                                            {{ $kampusData['keterangan'] }}
                                        </p>
                                    </div>

                                    {{-- Footer Info --}}
                                    <div class="mt-auto space-y-2 pt-4 border-t border-border-gray">
                                        <a href="{{ $kampusData['kampus']->website }}" target="_blank"
                                           class="flex items-center gap-2 text-sm text-slate-navy hover:text-cool-gray transition-colors group/link">
                                            <i class="fas fa-globe"></i>
                                            <span class="group-hover/link:underline truncate">Website Kampus</span>
                                            <i class="fas fa-external-link-alt text-xs ml-auto"></i>
                                        </a>

                                        <div class="flex items-start gap-2 text-sm text-cool-gray">
                                            <i class="fas fa-map-marker-alt mt-0.5 flex-shrink-0"></i>
                                            <span class="line-clamp-2">{{ $kampusData['kampus']->alamat }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-20 h-20 bg-slate-navy/5 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-university text-3xl text-cool-gray"></i>
                    </div>
                    <p class="text-cool-gray text-lg">
                        Belum ada data kampus yang tersedia untuk jurusan ini
                    </p>
                </div>
            @endif
        </div>
    @empty
        <div class="text-center py-20">
            <div class="w-24 h-24 bg-slate-navy/5 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-search text-4xl text-cool-gray"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-navy mb-2">
                Belum Ada Rekomendasi
            </h3>
            <p class="text-cool-gray text-lg">
                Belum ada rekomendasi jurusan berdasarkan nilai UTBK Anda
            </p>
        </div>
    @endforelse
</div>
