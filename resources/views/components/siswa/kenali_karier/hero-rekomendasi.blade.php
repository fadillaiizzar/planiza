@props([
    'title' => '',
    'desc' => '',
])

<div class="text-center mb-16 relative">
    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-12 w-32 h-32 bg-slate-navy opacity-5 rounded-full blur-3xl"></div>

    <div class="inline-block mb-4">
        <span class="px-4 py-2 bg-slate-navy/5 text-slate-navy text-sm font-semibold rounded-full border border-border-gray/30">
            ✨ Hasil Analisis Selesai
        </span>
    </div>

    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold text-slate-navy mb-6 leading-tight">
        {{ $title }}<br/>
        <span class="bg-gradient-to-r from-slate-navy to-cool-gray bg-clip-text text-transparent">
            Sudah Menunggu!
        </span>
    </h1>

    <p class="text-lg text-cool-gray max-w-2xl mx-auto leading-relaxed">
        {{ $desc }}
    </p>
</div>
