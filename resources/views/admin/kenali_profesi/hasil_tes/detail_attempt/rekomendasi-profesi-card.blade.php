<div class="bg-white rounded-2xl p-6 mb-10 shadow-lg border border-border-gray/30">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-navy to-cool-gray flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
        </div>
        <h2 class="text-lg font-bold text-slate-navy">Rekomendasi Teratas</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($topProfesi as $index => $profesi)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-navy to-cool-gray rounded-2xl opacity-0 group-hover:opacity-20 blur-xl transition-opacity duration-500"></div>
            <div class="relative bg-white rounded-2xl border-2 border-border-gray group-hover:border-slate-navy p-6 transition-all duration-500 group-hover:scale-[1.02]">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 py-1 rounded-full bg-off-white">
                            <span class="text-lg font-bold text-slate-navy">#{{ $index + 1 }}</span>
                        </div>
                        <h3 class="font-bold text-slate-navy text-base leading-snug">
                            {{ $profesi->nama_profesi_kerja }}
                        </h3>
                    </div>
                </div>
                <div class="flex items-end justify-between pt-4 border-t border-border-gray/50">
                    <div>
                        <p class="text-xs text-cool-gray mb-1 uppercase tracking-wide font-semibold">Total Poin</p>
                        <p class="text-3xl font-bold text-slate-navy">{{ $profesi->total_poin }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-slate-navy to-cool-gray flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
