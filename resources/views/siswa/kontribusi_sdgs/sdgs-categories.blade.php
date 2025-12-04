<div class="mt-16 relative">
    <!-- Header Section -->
    <div class="text-center mb-12 relative">
        <!-- Number Indicator -->
        <div class="inline-flex items-center gap-4 mb-6">
            <div class="h-px w-12 sm:w-16 bg-gradient-to-r from-transparent to-slate-navy"></div>
            <div class="relative">
                <div class="absolute inset-0 bg-slate-navy blur-lg opacity-30 animate-pulse"></div>
                <div class="relative bg-gradient-to-br from-slate-navy to-blue-900 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-2xl font-black text-lg sm:text-xl shadow-2xl">
                    17
                </div>
            </div>
            <div class="h-px w-12 sm:w-16 bg-gradient-to-l from-transparent to-slate-navy"></div>
        </div>

        <!-- Title with Gradient -->
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-slate-navy mb-2 sm:mb-3">
            Tujuan Pembangunan
        </h2>
        <h3 class="text-xl sm:text-2xl md:text-3xl font-black bg-gradient-to-r from-blue-600 via-green-600 to-blue-600 bg-clip-text text-transparent animate-gradient">
            Berkelanjutan
        </h3>

        <!-- Subtitle -->
        <p class="text-cool-gray mt-3 sm:mt-4 text-sm sm:text-base max-w-2xl mx-auto px-4 leading-relaxed">
            Geser untuk menjelajahi 17 tujuan global yang mengubah dunia
        </p>
    </div>

    <!-- Carousel Container -->
    <div class="relative px-4 sm:px-8 md:px-12 py-4">
        <!-- Navigation Buttons -->
        <button
            onclick="scrollSDG('left')"
            class="absolute left-2 sm:left-4 md:left-8 top-1/2 -translate-y-1/2 z-20 bg-white/90 hover:bg-white shadow-lg hover:shadow-xl rounded-full w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center text-slate-navy hover:text-blue-600 transition-all duration-200 border border-gray-200"
        >
            <i class="fas fa-chevron-left text-xs sm:text-sm"></i>
        </button>

        <button
            onclick="scrollSDG('right')"
            class="absolute right-2 sm:right-4 md:right-8 top-1/2 -translate-y-1/2 z-20 bg-white/90 hover:bg-white shadow-lg hover:shadow-xl rounded-full w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center text-slate-navy hover:text-blue-600 transition-all duration-200 border border-gray-200"
        >
            <i class="fas fa-chevron-right text-xs sm:text-sm"></i>
        </button>

        <!-- Scrollable Container -->
        <div
            id="sdgCarousel"
            class="flex gap-3 sm:gap-4 md:gap-5 overflow-x-auto scroll-smooth scrollbar-hide py-2"
            style="scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;"
        >
            @foreach($kategoriSdgs as $kategori)
                <button
                    onclick="showSDGDetail({{ $kategori->id }})"
                    class="group relative bg-white rounded-xl sm:rounded-2xl border border-border-gray hover:border-blue-400 hover:shadow-lg transition-all duration-200 overflow-hidden flex-shrink-0 w-32 sm:w-40 md:w-48 lg:w-52"
                    style="scroll-snap-align: start;"
                >
                    <!-- Animated Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-green-500/5 to-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>

                    <!-- Card Content -->
                    <div class="relative p-4 sm:p-5 md:p-6 text-center">
                        <!-- Corner Icon -->
                        <div class="absolute top-2 right-2 sm:top-3 sm:right-3 text-blue-400 group-hover:text-green-500 transition-colors duration-200">
                            <i class="fas fa-globe-asia text-sm sm:text-base opacity-50 group-hover:opacity-100"></i>
                        </div>

                        <!-- SDG Number -->
                        <div class="relative z-10 text-3xl sm:text-4xl md:text-5xl font-black bg-gradient-to-br from-slate-navy to-blue-900 bg-clip-text text-transparent mb-2 sm:mb-3 mt-1">
                            {{ $kategori->nomor_kategori }}
                        </div>

                        <!-- SDG Name -->
                        <div class="relative z-10 text-xs sm:text-sm font-medium text-gray-600 group-hover:text-slate-navy transition-colors duration-200 leading-tight line-clamp-3 min-h-[2.5rem] sm:min-h-[3rem]">
                            {{ $kategori->nama_kategori }}
                        </div>
                    </div>

                    <!-- Bottom Accent Line -->
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-500 via-green-500 to-blue-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></div>
                </button>
            @endforeach
        </div>
    </div>
</div>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
    function scrollSDG(direction) {
        const carousel = document.getElementById('sdgCarousel');
        const scrollAmount = carousel.offsetWidth * 0.6;

        if (direction === 'left') {
            carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }

    // Optional: Auto-scroll on mobile swipe
    document.getElementById('sdgCarousel')?.addEventListener('wheel', (e) => {
        if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) {
            e.preventDefault();
        }
    }, { passive: false });
</script>
