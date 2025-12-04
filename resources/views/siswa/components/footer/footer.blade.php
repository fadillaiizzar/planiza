<footer class="bg-slate-navy text-off-white px-4 pt-8 pb-6 md:px-8 lg:px-20">
    @php
        $user = auth()->user();
        $rencanaSiswa = $user->siswa->rencana?->nama_rencana ?? null;
    @endphp

    <div class="max-w-7xl mx-auto">
        <!-- Brand -->
        <div class="flex flex-col items-center text-center mb-8">
            <div class="text-2xl md:text-3xl font-bold mb-2">Planiza</div>
            <p class="text-gray-300 text-sm md:text-base max-w-2xl leading-relaxed">
                Platform edukasi digital untuk siswa SMK yang menyediakan materi belajar, eksplorasi, dan rekomendasi karir secara mudah dan interaktif
            </p>
        </div>

        <!-- Grid Section -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 text-left">
            <!-- Informasi -->
            <div>
                <h4 class="text-base md:text-lg font-semibold mb-3 text-off-white">Informasi</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('siswa.dashboard') }}" class="text-gray-300 hover:text-off-white transition-colors">Dashboard</a></li>
                    <li><a href="{{ route('siswa.bincang-karier.index') }}" class="text-gray-300 hover:text-off-white transition-colors">Bincang Karier</a></li>
                </ul>
            </div>

            <!-- Layanan -->
            <div>
                <h4 class="text-base md:text-lg font-semibold mb-3 text-off-white">Layanan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('siswa.materi.index') }}" class="text-gray-300 hover:text-off-white transition-colors">Materi</a></li>
                    <li>
                        <a href="{{ $rencanaSiswa === 'Kerja'
                            ? route('siswa.eksplorasi-profesi.index')
                            : route('siswa.eksplorasi-jurusan.index') }}"
                            class="text-gray-300 hover:text-off-white transition-colors">
                            Eksplorasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ $rencanaSiswa === 'Kerja'
                            ? route('siswa.kenali-profesi.index')
                            : route('siswa.kenali-jurusan.index') }}"
                            class="text-gray-300 hover:text-off-white transition-colors">
                            Kenali Karir
                        </a>
                    </li>
                    <li><a href="{{ route('siswa.kontribusi-sdgs.index') }}" class="text-gray-300 hover:text-off-white transition-colors">Kontribusi SDGs</a></li>
                </ul>
            </div>

            <!-- Aktivitas -->
            <div>
                <h4 class="text-base md:text-lg font-semibold mb-3 text-off-white">Aktivitas</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#profile" class="text-gray-300 hover:text-off-white transition-colors">Profile</a></li>
                    <li><a href="#kontak" class="text-gray-300 hover:text-off-white transition-colors">Kontak</a></li>
                </ul>
            </div>

            <!-- Hubungi Kami -->
            <div>
                <h4 class="text-base md:text-lg font-semibold mb-3 text-off-white">Hubungi Kami</h4>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2 text-gray-300">
                        <i class="fas fa-phone text-xs"></i>
                        <span>0857-1368-5277</span>
                    </li>
                    <li class="flex items-center gap-2 text-gray-300">
                        <i class="fas fa-envelope text-xs"></i>
                        <span>info@planiza.id</span>
                    </li>
                    <li class="flex gap-3 pt-2">
                        <a href="#" class="w-8 h-8 bg-cool-gray/20 rounded-full flex items-center justify-center hover:bg-border-gray hover:text-slate-navy transition-all duration-300">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-cool-gray/20 rounded-full flex items-center justify-center hover:bg-border-gray hover:text-slate-navy transition-all duration-300">
                            <i class="fab fa-tiktok text-sm"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-cool-gray/20 rounded-full flex items-center justify-center hover:bg-border-gray hover:text-slate-navy transition-all duration-300">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="mt-8 mb-5 border-cool-gray/30">

        <div class="text-center text-gray-300 text-xs md:text-sm">
            &copy; 2025 - Fadilla Izza Rahmadani
        </div>
    </div>
</footer>
