<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-navy mb-3">
            Rekomendasi Berdasarkan Hobi
        </h2>
        <div class="w-24 h-1 bg-slate-navy mx-auto"></div>
    </div>

    @if(count($rekomHobi) > 0)

        {{-- Grid Jurusan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($rekomHobi as $jurusan)
                @foreach(($jurusan['jurusan_list'] ?? [$jurusan['jurusan'] ?? null]) as $item)
                    @if($item)
                        <div class="group relative">
                            <div class="bg-white rounded-3xl border border-border-gray hover:border-slate-navy transition-all duration-300 overflow-hidden h-full flex flex-col shadow-sm hover:shadow-lg">

                                {{-- Header Card --}}
                                <div class="relative bg-gradient-to-br from-slate-navy/5 to-cool-gray/5 p-8 flex items-center justify-center">
                                    <div class="w-16 h-16 bg-slate-navy rounded-2xl flex items-center justify-center shadow-md group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                        <i class="fas fa-graduation-cap text-2xl text-off-white"></i>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="p-5 flex-grow flex flex-col">
                                    <h4 class="font-bold text-lg text-slate-navy line-clamp-2 min-h-[3rem]">
                                        {{ $item->nama_jurusan_kuliah }}
                                    </h4>

                                    @if(!empty($jurusan['hobi_asal']))
                                        <p class="text-slate-navy mt-2 mb-5 text-base leading-relaxed">
                                            Jurusan ini direkomendasikan karena kamu memiliki minat dalam
                                            <span>
                                                {{ implode(', ', $jurusan['hobi_asal']) }}
                                            </span>
                                        </p>
                                    @else
                                        <p class="text-slate-navy mt-2 mb-5 text-base leading-relaxed">
                                            Jurusan ini sesuai dengan beberapa hobi yang kamu pilih
                                        </p>
                                    @endif

                                    <div class="mt-auto ">
                                        <a href="{{ route('siswa.eksplorasi-jurusan.show', $item->id) }}"
                                           class="flex items-center justify-center gap-1.5 w-full px-5 py-2.5 bg-slate-navy text-off-white font-semibold rounded-full hover:bg-cool-gray transition-all duration-300 shadow-md hover:shadow-lg">
                                            <span>Lihat Detail</span>
                                            <i class="fas fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    @else
        {{-- Fallback --}}
        <div class="text-center py-20">
            <div class="w-24 h-24 bg-slate-navy/5 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-heart text-4xl text-cool-gray"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-navy mb-2">Belum Ada Rekomendasi</h3>
            <p class="text-cool-gray text-lg">Belum ada rekomendasi jurusan berdasarkan hobi Anda</p>
        </div>
    @endif
</div>
