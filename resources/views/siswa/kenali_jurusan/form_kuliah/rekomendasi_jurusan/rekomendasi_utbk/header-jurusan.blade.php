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
