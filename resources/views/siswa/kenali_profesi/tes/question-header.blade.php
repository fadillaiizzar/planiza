<div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-navy rounded-2xl mb-6 shadow-xl">
        <span class="text-off-white text-xl font-bold">{{ $index + 1 }}</span>
    </div>

    <h2 class="text-2xl sm:text-3xl font-bold text-slate-navy mb-4 leading-tight">
        {{ $soal->isi_pertanyaan }}
    </h2>

    <div class="w-24 h-1 mb-4 bg-slate-navy rounded-full mx-auto"></div>

    @if($soal->max_select > 1)
        <p class="text-sm text-slate-500 mb-3">
            pilih maksimal <span class="font-semibold text-slate-navy">{{ $soal->max_select }}</span> jawaban
        </p>
    @endif
</div>
