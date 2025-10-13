<div class="relative mt-20">
    <!-- Floating Decorative Elements -->
    <div class="absolute -top-6 -right-6 w-24 h-24 bg-gradient-to-br from-cool-gray to-slate-navy rounded-full opacity-20 animate-pulse"></div>
    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-br from-cool-gray to-slate-navy rounded-full opacity-25 animate-bounce"></div>

    <!-- Main Test Card -->
    <div class="relative bg-white rounded-3xl shadow-2xl border border-border-gray overflow-hidden group hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2">
        <div class="bg-gradient-to-r from-slate-navy via-cool-gray to-slate-navy p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-sm flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold">Form Kuliah</h3>
                </div>

                <p class="text-off-white leading-relaxed">
                    Masukkan nilai UTBK, jurusan yang kamu minati, dan hobi untuk mendapatkan rekomendasi jurusan kuliah yang sesuai
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
                    🎓 <span>Form Meliputi :</span>
                </h4>

                <div class="flex flex-col lg:flex-row gap-5">
                    <!-- Nilai UTBK -->
                    <div class="group flex pl-5 pr-16 py-3 rounded-2xl bg-gradient-to-r from-off-white to-border-gray border-l-4 border-cool-gray transform transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-slate-navy rounded-xl text-white flex items-center justify-center">
                                <i class="fas fa-chart-line text-lg"></i>
                            </div>
                            <span class="text-slate-navy text-base">Nilai UTBK</span>
                        </div>
                    </div>

                    <!-- Jurusan Diminati -->
                    <div class="group flex pl-5 pr-16 py-3 rounded-2xl bg-gradient-to-r from-off-white to-border-gray border-l-4 border-cool-gray transform transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-slate-navy rounded-xl text-white flex items-center justify-center">
                                <i class="fas fa-list-ul text-lg"></i>
                            </div>
                            <span class="text-slate-navy text-base">Jurusan Diminati</span>
                        </div>
                    </div>

                    <!-- Hobi -->
                    <div class="group flex pl-5 pr-16 py-3 rounded-2xl bg-gradient-to-r from-off-white to-border-gray border-l-4 border-cool-gray transform transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-slate-navy rounded-xl text-white flex items-center justify-center">
                                <i class="fas fa-heart text-lg"></i>
                            </div>
                            <span class="text-slate-navy text-base">Hobi & Aktivitas Favorit</span>
                        </div>
                    </div>
                </div>
            </div>

            <x-siswa.kenali_karier.button-banner
                text="Mulai Isi Form Sekarang"
            />
        </div>
    </div>
</div>

@include('siswa.kenali_jurusan.banner_form.popup-konfirmasi')
