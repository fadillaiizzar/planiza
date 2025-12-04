<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-4 border border-border-gray">
        <p class="text-xs text-cool-gray mb-1">Total Pertanyaan</p>
        <p class="text-2xl font-bold text-slate-navy">{{ $totalQuestions }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 border border-border-gray">
        <p class="text-xs text-cool-gray mb-1">Pertanyaanku</p>
        <p class="text-2xl font-bold text-slate-navy">{{ $myQuestions }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 border border-border-gray">
        <p class="text-xs text-cool-gray mb-1">Sudah Dijawab</p>
        <p class="text-2xl font-bold text-green-600">{{ $answeredQuestions }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 border border-border-gray">
        <p class="text-xs text-cool-gray mb-1">Menunggu Jawaban</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $pendingQuestions }}</p>
    </div>
</div>
