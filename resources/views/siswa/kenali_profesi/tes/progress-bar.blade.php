<div class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-border-gray/20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-white text-sm"></i>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-slate-navy">{{ $tes->nama_tes }}</h1>
                    <p class="text-sm text-cool-gray">Kerjakan semua soal sesuai dengan minatmu</p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-sm font-semibold text-slate-navy" id="question-counter">1 / {{ $soals->count() }}</div>
                <div class="text-xs text-cool-gray">Pertanyaan</div>
            </div>
        </div>
        <div class="w-full bg-border-gray/30 rounded-full h-2">
            <div id="progress-bar" class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full transition-all duration-500" style="width: {{ (1 / $soals->count()) * 100 }}%"></div>
        </div>
    </div>
</div>
