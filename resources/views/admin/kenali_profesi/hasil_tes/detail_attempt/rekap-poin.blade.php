<div class="bg-white rounded-2xl overflow-hidden mb-10 shadow-lg border border-border-gray/30">
    <div class="px-6 py-5 border-b border-border-gray/30 bg-gradient-to-br from-off-white to-white">
        <h2 class="text-lg font-bold text-slate-navy">Rekap Total Poin per Profesi</h2>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
            @foreach ($poinProfesi as $i => $profesi)
            <div class="group flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-off-white to-white border border-border-gray/50 hover:border-slate-navy/30 hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-4 flex-1">
                    <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-navy/5 flex items-center justify-center group-hover:bg-slate-navy/10 transition-colors duration-300">
                        <span class="text-sm font-bold text-slate-navy">{{ $i + 1 }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-navy truncate">{{ $profesi->nama_profesi_kerja }}</p>
                    </div>
                </div>
                <div class="flex-shrink-0 ml-4">
                    <div class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-slate-navy to-cool-gray shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                        <span class="text-white font-bold text-lg">{{ $profesi->total_poin }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
