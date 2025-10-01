<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Siswa - Planiza')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="font-poppins bg-off-white min-h-screen">
    <div class="min-h-screen bg-off-white flex items-center justify-center px-4 py-12">
        <div class="max-w-2xl w-full">
            <!-- Icon Container -->
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <div class="w-32 h-32 bg-gradient-to-br from-slate-navy to-cool-gray rounded-full flex items-center justify-center shadow-2xl">
                        <svg class="w-16 h-16 text-off-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <!-- Decorative Elements -->
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-cool-gray rounded-full opacity-50"></div>
                    <div class="absolute -bottom-3 -left-3 w-12 h-12 bg-slate-navy rounded-full opacity-30"></div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-border-gray">
                <div class="p-10 text-center">
                    <!-- Badge -->
                    <div class="inline-flex items-center px-4 py-2 bg-off-white rounded-full border border-border-gray mb-6">
                        <span class="w-2 h-2 bg-cool-gray rounded-full mr-2 animate-pulse"></span>
                        <span class="text-sm font-medium text-cool-gray">Status Tes</span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-slate-navy mb-4">
                        Belum Ada Tes Aktif
                    </h1>

                    <!-- Description -->
                    <p class="text-lg text-cool-gray mb-8 leading-relaxed">
                        Saat ini belum ada tes profesi yang tersedia untuk Anda. Tes baru akan muncul ketika administrator mengaktifkannya.
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button onclick="window.location.reload()" class="px-8 py-4 bg-slate-navy text-off-white rounded-2xl font-semibold hover:bg-opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Muat Ulang
                            </span>
                        </button>

                        <a href="{{ route('siswa.kenali-profesi.index') }}" class="px-8 py-4 bg-off-white text-slate-navy border-2 border-border-gray rounded-2xl font-semibold hover:bg-border-gray transition-all duration-300">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali ke Beranda
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Footer Info -->
                <div class="bg-off-white border-t border-border-gray px-10 py-6">
                    <div class="flex items-center justify-center text-cool-gray text-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Hubungi administrator jika memerlukan bantuan lebih lanjut</span>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-8 text-center">
                <p class="text-cool-gray text-sm">
                    Terakhir diperbarui : <span class="font-semibold">{{ now()->format('d M Y, H:i') }}</span>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
