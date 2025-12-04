<div class="mt-20 relative overflow-hidden rounded-3xl group">
    <div class="absolute inset-0 bg-gradient-to-r from-slate-navy via-blue-900 to-slate-navy"></div>

    <div class="relative px-8 py-20 text-center">
        <!-- Rocket Icon -->
        <div class="mb-6 inline-block">
            <div class="text-7xl animate-bounce-slow">🚀</div>
        </div>

        <!-- Badge -->
        <div class="inline-flex items-center gap-2 bg-white bg-opacity-15 backdrop-blur-md border border-white border-opacity-30 rounded-full px-6 py-2 mb-6">
            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
            <span class="text-slate-navy text-sm font-bold tracking-wider">SIAP BERKONTRIBUSI ?</span>
        </div>

        <!-- Main Title -->
        <h2 class="text-4xl md:text-5xl font-black text-white mb-4 leading-tight">
            Saatnya Kamu
            <span class="block mt-2 bg-gradient-to-r from-blue-300 via-green-300 to-blue-300 bg-clip-text text-transparent">
                Membuat Perubahan
            </span>
        </h2>

        <!-- Subtitle -->
        <p class="text-blue-100 mb-10 max-w-2xl mx-auto font-medium">
            Jangan tunggu besok. Jangan tunggu nanti.
            Mulai hari ini dan jadilah bagian dari gerakan global! 🌍
        </p>

        <!-- CTA Button Group -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <button
                onclick="openKontribusiModal()"
                class="group/btn relative inline-flex items-center gap-3 bg-white text-slate-navy p-5 rounded-2xl font-black text-lg hover:shadow-2xl transition-all duration-300 overflow-hidden"
            >
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-green-50 opacity-0 group-hover/btn:opacity-100 transition-opacity"></div>
                <span class="relative flex items-center gap-3">
                    <span class="text-2xl group-hover/btn:scale-110 transition-transform">✨</span>
                    <span>Aku Mau Berkontribusi!</span>
                    <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </span>
            </button>

            <!-- Stats Preview -->
            <div class="flex items-center gap-4 bg-white bg-opacity-10 backdrop-blur-md border border-white border-opacity-30 rounded-2xl px-8 py-3">
                <div class="text-center">
                    <div class="text-2xl font-black text-white">{{ $totalKontribusiSdgs }}+</div>
                    <div class="text-xs text-blue-200">Kontribusi</div>
                </div>
            </div>
        </div>
    </div>
</div>
