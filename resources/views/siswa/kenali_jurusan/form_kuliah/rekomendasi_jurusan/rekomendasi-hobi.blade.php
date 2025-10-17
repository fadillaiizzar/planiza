<h2 class="text-2xl font-bold text-slate-navy mb-6 text-center">Rekomendasi Berdasarkan Hobi</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-16">
    @forelse($rekomHobi as $index => $jurusan)
        <div class="group relative transition-all duration-500 hover:scale-105 hover:-translate-y-2">
            <div class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden border border-border-gray/20 h-full flex flex-col relative">

                {{-- Card Icon --}}
                <div class="relative h-40 bg-gradient-to-br from-slate-navy/5 to-cool-gray/10 flex items-center justify-center overflow-hidden">
                    <div class="relative z-10 w-20 h-20 bg-white rounded-2xl shadow-lg flex items-center justify-center transform group-hover:scale-110 transition-all duration-500">
                        <i class="fas fa-university text-3xl text-slate-navy"></i>
                    </div>
                </div>

                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="font-bold text-xl text-slate-navy mb-2">
                        {{ $jurusan['jurusan']->nama_jurusan_kuliah }}
                    </h3>

                    <a href="{{ route('siswa.eksplorasi-jurusan.show', $jurusan['jurusan']->id) }}"
                        class="mt-auto inline-flex items-center justify-center px-6 py-3.5 bg-slate-navy text-white rounded-xl font-semibold overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-105">
                        <span class="relative z-10 flex items-center gap-2">
                            Lihat Detail Jurusan
                            <i class="fas fa-arrow-right transform transition-transform"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-cool-gray italic mb-12">
            Belum ada rekomendasi berdasarkan hobi tersedia
        </p>
    @endforelse
</div>
