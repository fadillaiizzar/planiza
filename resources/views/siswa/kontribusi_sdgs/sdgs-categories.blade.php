<div class="mt-16 relative">
    <div class="text-center mb-12 relative">
        <!-- Number Indicator -->
        <div class="inline-flex items-center gap-4 mb-6">
            <div class="h-px w-16 bg-gradient-to-r from-transparent to-slate-navy"></div>
            <div class="relative">
                <div class="absolute inset-0 bg-slate-navy blur-lg opacity-30"></div>
                <div class="relative bg-gradient-to-br from-slate-navy to-blue-900 text-white px-8 py-3 rounded-2xl font-black text-xl shadow-xl">
                    17
                </div>
            </div>
            <div class="h-px w-16 bg-gradient-to-l from-transparent to-slate-navy"></div>
        </div>

        <!-- Title with Gradient -->
        <h2 class="text-3xl md:text-4xl font-black text-slate-navy mb-3">
            Tujuan Pembangunan
        </h2>
        <h3 class="text-2xl md:text-3xl font-black bg-gradient-to-r from-blue-600 via-green-600 to-blue-600 bg-clip-text text-transparent">
            Berkelanjutan
        </h3>

        <!-- Subtitle -->
        <p class="text-cool-gray mt-4 max-w-2xl mx-auto leading-relaxed">
            Klik setiap kartu untuk mempelajari lebih lanjut tentang tujuan global yang mengubah dunia
        </p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6 mt-8">
        @foreach($kategoriSdgs as $kategori)
            <button
                onclick="showSDGDetail({{ $kategori->id }})"
                class="group relative bg-white rounded-2xl border border-border-gray hover:border-transparent hover:shadow-2xl hover:scale-[1.03] transition-all duration-300 overflow-hidden p-5 text-center"
            >
                <!-- Background gradient overlay -->
                <div class="absolute inset-0 bg-gradient-to-br from-blue-100 via-green-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <!-- Icon pojok kanan atas -->
                <div class="absolute top-3 right-3 text-blue-500 group-hover:text-green-500 transition-colors duration-300">
                    <i class="fas fa-globe-asia text-lg md:text-xl opacity-70 group-hover:opacity-100"></i>
                </div>

                <!-- Nomor SDG -->
                <div class="relative z-10 text-3xl md:text-4xl font-extrabold text-slate-navy mb-2 mt-2 group-hover:scale-110 transition-transform duration-300">
                    {{ $kategori->nomor_kategori }}
                </div>

                <!-- Nama SDG -->
                <div class="relative z-10 text-xs md:text-sm font-semibold text-gray-600 group-hover:text-slate-navy transition-colors duration-300 leading-tight line-clamp-3">
                    {{ $kategori->nama_kategori }}
                </div>
            </button>
        @endforeach
    </div>
</div>
