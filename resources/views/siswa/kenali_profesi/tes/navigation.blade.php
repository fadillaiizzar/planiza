<div class="mt-12 pt-8 border-t border-border-gray/30">
    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
        <button id="prev-btn"
            class="w-full sm:w-auto px-8 py-4 bg-off-white hover:bg-border-gray/20 border-2 border-border-gray/40 hover:border-border-gray text-cool-gray hover:text-slate-navy rounded-2xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-off-white disabled:hover:border-border-gray/40 shadow-lg"
            disabled>
            <i class="fas fa-arrow-left text-sm"></i>
            <span>Sebelumnya</span>
        </button>

        <div class="hidden sm:block text-center">
            <div class="text-sm text-cool-gray bg-border-gray/20 px-4 py-2 rounded-full">
                <i class="fas fa-keyboard text-xs mr-1"></i>
                Tekan spasi untuk melanjutkan
            </div>
        </div>

        <button id="next-btn"
            class="w-full sm:w-auto px-8 py-4 bg-slate-navy hover:bg-slate-navy/90 text-off-white rounded-2xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2 shadow-xl hover:shadow-2xl transform hover:scale-105">
            <span>Selanjutnya</span>
            <i class="fas fa-arrow-right text-sm"></i>
        </button>

        <form id="submit-form" action="{{ route('siswa.kenali-profesi.tes.submit', $tes->id) }}" method="POST" class="hidden w-full sm:w-auto">
            @csrf
            <button type="submit"
                class="w-full sm:w-auto px-8 py-4 bg-slate-navy hover:bg-slate-navy/90 text-off-white rounded-2xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2 shadow-xl hover:shadow-2xl transform hover:scale-105 relative overflow-hidden">
                <i class="fas fa-check-circle text-sm"></i>
                <span>Selesai & Lihat Rekomendasi</span>
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-off-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
            </button>
        </form>
    </div>
</div>
