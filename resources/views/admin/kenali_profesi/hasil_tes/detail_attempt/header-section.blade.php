<div class="relative bg-white rounded-2xl p-8 mb-8 overflow-hidden shadow-lg border border-border-gray/30">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-slate-navy via-cool-gray to-slate-navy"></div>
    <div class="relative z-10">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-navy to-cool-gray flex items-center justify-center shadow-lg">
                <span class="text-white font-bold text-lg">{{ $attempt }}</span>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-navy tracking-tight">
                    Detail Attempt
                </h1>
            </div>
        </div>
        <div class="ml-15 space-y-1">
            <p class="text-slate-navy font-medium">{{ $user->name }}</p>
            <p class="text-cool-gray text-sm">{{ $tes->nama_tes }}</p>
        </div>
    </div>
</div>
