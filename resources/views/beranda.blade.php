<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-off-white text-gray-800 font-poppins">

    <!-- Navbar Beranda -->
    <nav class="bg-off-white shadow-sm border-b border-border-gray rounded-b-[25px] fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Hamburger & Links -->
            <div class="flex items-center">
                <!-- Hamburger (mobile) -->
                <button id="hamburger" class="block md:hidden text-2xl text-cool-gray focus:outline-none mr-4">
                    ☰
                </button>
                <!-- Navigation Links (desktop) -->
                <div id="navLinks" class="hidden md:flex space-x-6 font-medium">
                    <a href="#beranda" class="text-cool-gray hover:text-slate-navy transition">Beranda</a>
                    <a href="#tentang" class="text-cool-gray hover:text-slate-navy transition">Tentang</a>
                    <a href="#layanan" class="text-cool-gray hover:text-slate-navy transition">Layanan</a>
                </div>
            </div>

            <!-- Logo -->
            <div class="text-xl font-bold text-slate-navy">Planiza</div>

            <!-- Login Button -->
            <div>
                <a href="{{ route('login') }}" class="bg-slate-navy text-off-white px-4 py-2 rounded-md hover:opacity-90 transition">Login</a>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobileMenu" class="md:hidden hidden px-6 pb-4">
            <a href="#beranda" class="block py-2 text-cool-gray hover:text-slate-navy">Beranda</a>
            <a href="#tentang" class="block py-2 text-cool-gray hover:text-slate-navy">Tentang</a>
            <a href="#layanan" class="block py-2 text-cool-gray hover:text-slate-navy">Layanan</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="h-screen flex flex-col justify-center items-center text-center px-4 bg-off-white">
        <h1 class="text-5xl font-extrabold text-slate-navy mb-4 drop-shadow-lg">Planiza</h1>
        <p class="text-cool-gray mb-6 max-w-xl">Brand Promosie – Solusi Digital Edukasi & Karier yang Membuka Peluang Masa Depanmu.</p>
        <a href="#layanan" class="bg-slate-navy text-off-white px-6 py-3 rounded-md text-base font-semibold hover:scale-105 transition duration-300">Jelajahi Fitur</a>
    </section>

    <!-- Info Section -->
    <section id="tentang" class="relative bg-off-white from-off-white via-off-white/90 to-slate-navy py-24">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Box Kiri -->
            <div class="md:col-span-2 bg-off-white border border-gray-300 rounded-2xl p-10 shadow-xl flex items-center justify-center text-center min-h-[250px]">
                <p class="text-cool-gray leading-relaxed max-w-xl">
                    Planiza adalah platform edukasi digital untuk siswa SMK yang menyediakan materi belajar, eksplorasi,
                    dan rekomendasi untuk mengenali profesi kerja serta jurusan kuliah secara mudah dan interaktif.
                </p>
            </div>

            <!-- Box Kanan -->
            <div class="md:col-span-1 bg-off-white border border-gray-300 rounded-2xl p-8 shadow-xl flex flex-col justify-center items-center text-center">
                <div class="mb-6">
                    <p class="text-3xl font-bold text-slate-navy mb-1">20+</p>
                    <p class="text-cool-gray text-base">Eksplorasi Profesi</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-navy mb-1">20+</p>
                    <p class="text-cool-gray text-base">Eksplorasi Jurusan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Alasan Memilih Planiza -->
    <section class="bg-slate-900 text-off-white py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-12">Mengapa Memilih Planiza?</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Fitur 1 -->
                <div class="rounded-2xl px-8 hover:shadow-2xl transition duration-300 flex flex-col items-center text-center">
                    <div class="bg-indigo-500 text-off-white p-4 rounded-full shadow-md mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Materi Terarah</h3>
                    <p class="text-slate-300">Konten belajar disusun sesuai kebutuhan siswa SMK secara praktis dan aplikatif.</p>
                </div>

                <!-- Fitur 2 -->
                <div class="rounded-2xl px-8 hover:shadow-2xl transition duration-300 flex flex-col items-center text-center">
                    <div class="bg-pink-500 text-off-white p-4 rounded-full shadow-md mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 8v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Eksplorasi Interaktif</h3>
                    <p class="text-slate-300">Fitur eksplorasi profesi & jurusan yang interaktif membantu siswa mengenali minatnya.</p>
                </div>

                <!-- Fitur 3 -->
                <div class="rounded-2xl px-8 hover:shadow-2xl transition duration-300 flex flex-col items-center text-center">
                    <div class="bg-emerald-500 text-off-white p-4 rounded-full shadow-md mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.314 4 5 4 5s-4 1.686-4 5c0-3.314-4-5-4-5s4-1.686 4-5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Tampilan Menarik</h3>
                    <p class="text-slate-300">Desain modern dan mudah digunakan, membuat belajar jadi menyenangkan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="layanan" class="py-20 bg-off-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-navy mb-12 text-center">Layanan Kami</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-off-white border border-border p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                    <div class="bg-blue-500 text-off-white p-2 rounded-lg shadow-sm mb-4 w-12 h-12 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-navy mb-3">Materi</h3>
                    <p class="text-cool-gray mb-4 text-sm leading-relaxed">Akses materi sesuai kelas dan jurusan</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm inline-flex items-center group-hover:translate-x-1 transition-transform">
                        Pelajari <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <div class="bg-off-white border border-border p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                    <div class="bg-green-500 text-off-white p-2 rounded-lg shadow-sm mb-4 w-12 h-12 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-navy mb-3">Eksplorasi</h3>
                    <p class="text-cool-gray mb-4 text-sm leading-relaxed">Jelajahi berbagai profesi dan minat</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm inline-flex items-center group-hover:translate-x-1 transition-transform">
                        Pelajari <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <div class="bg-off-white border border-border p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                    <div class="bg-purple-500 text-off-white p-2 rounded-lg shadow-sm mb-4 w-12 h-12 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-navy mb-3">Kenali Karir</h3>
                    <p class="text-cool-gray mb-4 text-sm leading-relaxed">Temukan profesi yang tepat untukmu</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm inline-flex items-center group-hover:translate-x-1 transition-transform">
                        Pelajari <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <div class="bg-off-white border border-border p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                    <div class="bg-orange-500 text-off-white p-2 rounded-lg shadow-sm mb-4 w-12 h-12 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-navy mb-3">Kontribusi SDGs</h3>
                    <p class="text-cool-gray mb-4 text-sm leading-relaxed">Berkontribusi untuk masa depan</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm inline-flex items-center group-hover:translate-x-1 transition-transform">
                        Pelajari <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <div class="bg-off-white border border-border p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                    <div class="bg-teal-500 text-off-white p-2 rounded-lg shadow-sm mb-4 w-12 h-12 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-navy mb-3">Bincang Karir</h3>
                    <p class="text-cool-gray mb-4 text-sm leading-relaxed">Konsultasi dengan mentor ahli</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm inline-flex items-center group-hover:translate-x-1 transition-transform">
                        Pelajari <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-navy text-off-white px-6 py-10 md:px-20">
        <div class="max-w-7xl mx-auto">
            <!-- Brand -->
            <div class="flex flex-col items-center text-center mb-10">
                <div class="text-3xl font-bold mb-3">Planiza</div>
                <p class="text-gray-300 max-w-3xl leading-relaxed">
                    Platform edukasi digital untuk siswa SMK yang menyediakan materi belajar, eksplorasi, dan rekomendasi kenali profesi kerja serta jurusan kuliah secara mudah dan interaktif
                </p>
            </div>

            <!-- Grid Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-10 text-center md:text-left">
                <!-- Informasi -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Informasi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-off-white transition-colors hover:translate-x-1 inline-block">Dashboard</a></li>
                        <li><a href="#" class="hover:text-off-white transition-colors hover:translate-x-1 inline-block">Bincang Karier</a></li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-off-white transition-colors hover:translate-x-1 inline-block">Materi</a></li>
                        <li><a href="#" class="hover:text-off-whitee transition-colors hover:translate-x-1 inline-block">Eksplorasi</a></li>
                        <li><a href="#" class="hover:text-off-white transition-colors hover:translate-x-1 inline-block">Kenali Karir</a></li>
                        <li><a href="#" class="hover:text-off-white transition-colors hover:translate-x-1 inline-block">Kontribusi SDGs</a></li>
                    </ul>
                </div>

                <!-- Aktivitas -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Aktivitas</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-off-white transition-colors hover:translate-x-1 inline-block">Profile</a></li>
                        <li><a href="#" class="hover:text-off-white transition-colors hover:translate-x-1 inline-block">Kontak</a></li>
                    </ul>
                </div>

                <!-- Hubungi Kami -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Hubungi Kami</h4>
                    <ul class="text-gray-300 space-y-3">
                        <li class="flex items-center justify-center md:justify-start gap-3 group">
                            <i class="fas fa-phone text-border-gray group-hover:scale-110 transition-transform"></i>
                            <span class="group-hover:text-off-white transition-colors">0857-1368-5277</span>
                        </li>
                        <li class="flex items-center justify-center md:justify-start gap-3 group">
                            <i class="fas fa-envelope text-border-gray group-hover:scale-110 transition-transform"></i>
                            <span class="group-hover:text-off-white transition-colors">info@planiza.id</span>
                        </li>
                        <li class="flex justify-center md:justify-start space-x-4 pt-4">
                            <a href="#" class="w-10 h-10 bg-cool-gray rounded-full flex items-center justify-center hover:bg-border-gray hover:text-slate-navy transition-all duration-300 hover:scale-110">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-cool-gray rounded-full flex items-center justify-center hover:bg-border-gray hover:text-slate-navy transition-all duration-300 hover:scale-110">
                                <i class="fab fa-tiktok"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-cool-gray rounded-full flex items-center justify-center hover:bg-border-gray hover:text-slate-navy transition-all duration-300 hover:scale-110">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="mt-10 mb-7 border-gray-700">

            <div class="text-center text-gray-400 text-sm">
                &copy; 2025 - Fadilla Izza Rahmadani
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hamburger = document.getElementById("hamburger");
            const mobileMenu = document.getElementById("mobileMenu");

            hamburger.addEventListener("click", function () {
                mobileMenu.classList.toggle("hidden");
            });
        });
    </script>
</body>
</html>
