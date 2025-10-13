<div class="relative mt-20">

    <!-- Floating Elements for Visual Interest -->
    <div class="absolute -top-6 -right-6 w-24 h-24 bg-gradient-to-br from-cool-gray to-slate-navy rounded-full opacity-20 animate-pulse"></div>
    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-br from-cool-gray to-slate-navy rounded-full opacity-25 animate-bounce"></div>

    <!-- Main Test Card -->
    <div class="relative bg-white rounded-3xl shadow-2xl border border-border-gray overflow-hidden group hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2">
        <div class="bg-gradient-to-r from-slate-navy via-cool-gray to-slate-navy p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-sm flex items-center justify-center">
                        <i class="fas fa-brain text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold">Tes Minat & Bakat</h3>
                </div>

                <p class="text-off-white leading-relaxed">
                    Jawablah beberapa pertanyaan tentang minat dan aktivitas favoritmu untuk mendapat rekomendasi profesi yang sesuai
                </p>
            </div>

            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-8">
                    <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" fill="rgba(255,255,255,0.1)"></path>
                </svg>
            </div>
        </div>

        <!-- Content Body -->
        <div class="p-8 space-y-6">
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-slate-navy mb-3 flex items-center gap-2">
                    🧪 <span>Tes Meliputi :</span>
                </h4>

                <div class="flex flex-col lg:flex-row gap-5">
                    <!-- Pilihan Ganda -->
                    <div class="group flex pl-5 pr-16 py-3 rounded-2xl bg-gradient-to-r from-off-white to-border-gray border-l-4 border-cool-gray transform transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-slate-navy rounded-xl text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                </svg>
                            </div>
                            <span class="text-slate-navy text-base">Pilihan Ganda (Minat & Bakat)</span>
                        </div>
                    </div>

                    <!-- Multiple Choice -->
                    <div class="group flex pl-5 pr-16 py-3 rounded-2xl bg-gradient-to-r from-off-white to-border-gray border-l-4 border-cool-gray transform transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-slate-navy rounded-xl text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"/>
                                </svg>
                            </div>
                            <span class="text-slate-navy text-base">Pilih Lebih dari Satu (Skill)</span>
                        </div>
                    </div>
                </div>
            </div>

            <x-siswa.kenali_karier.button-banner
                text="Mulai Tes Sekarang"
            />
        </div>
    </div>
</div>

@include('siswa.kenali_profesi.banner_tes.popup-konfirmasi')
