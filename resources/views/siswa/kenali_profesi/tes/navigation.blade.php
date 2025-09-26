<div class="mt-12 pt-8 border-t border-border-gray/20">
    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
        <button id="prev-btn"
            class="w-full sm:w-auto px-8 py-4 bg-white hover:bg-gray-50 border-2 border-border-gray/30 hover:border-border-gray text-cool-gray hover:text-slate-navy rounded-2xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-white disabled:hover:border-border-gray/30"
            disabled>
            <i class="fas fa-arrow-left text-sm"></i>
            <span>Sebelumnya</span>
        </button>

        <div class="hidden sm:block text-center">
            <div class="text-sm text-cool-gray">Tekan spasi untuk melanjutkan</div>
        </div>

        <button id="next-btn"
            class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-2xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105">
            <span>Selanjutnya</span>
            <i class="fas fa-arrow-right text-sm"></i>
        </button>

        <form id="submit-form" action="{{ route('siswa.kenali-profesi.tes.submit', $tes->id) }}" method="POST" class="hidden w-full sm:w-auto">
            @csrf
            <button type="submit"
                class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-2xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                <i class="fas fa-check-circle text-sm"></i>
                <span>Selesai & Lihat Rekomendasi</span>
            </button>
        </form>
    </div>
</div>
