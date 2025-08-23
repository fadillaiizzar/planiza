<div class="col-span-full flex flex-col items-center justify-center py-16 px-6 bg-gradient-to-r from-slate-50 to-slate-100 border border-dashed border-slate-300 rounded-2xl shadow-sm">
    <i class="fas fa-box-open text-5xl text-slate-400 mb-4"></i>
    <h3 class="text-lg font-bold text-slate-700 mb-2">{{ $title ?? 'Belum ada data' }}</h3>
    <p class="text-slate-500 text-center max-w-md">
        {{ $message ?? 'Data akan segera ditambahkan. Sementara itu, coba jelajahi bagian lain dulu' }}
    </p>
</div>
