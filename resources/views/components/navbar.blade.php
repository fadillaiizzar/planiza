@props(['user'])

<nav class="bg-off-white shadow-sm border-b border-border rounded-b-[25px] fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Hamburger & Navigation Links -->
        <div class="flex items-center">
            <!-- Hamburger (mobile) -->
            <button id="hamburger-dashboard" class="block md:hidden text-2xl text-cool-gray focus:outline-none mr-4">
                ☰
            </button>

            <!-- Navigation Links (desktop) -->
            <div id="navLinksDashboard" class="hidden md:flex space-x-6 font-medium">
                <a href="#materi" class="text-cool-gray hover:text-slate-navy transition">Materi</a>
                <a href="#eksplorasi" class="text-cool-gray hover:text-slate-navy transition">Eksplorasi</a>
                <a href="#kenali-karier" class="text-cool-gray hover:text-slate-navy transition">Kenali Karir</a>
                <a href="#bincang-karier" class="text-cool-gray hover:text-slate-navy transition">Bincang Karir</a>
            </div>
        </div>

        <!-- Logo (center) -->
        <div class="text-xl font-bold text-slate-navy">
            Planiza
        </div>

        <!-- Profile & Logout (right) -->
        <div class="flex items-center space-x-4">
            <div class="relative group">
                <button class="flex items-center space-x-2 text-cool-gray hover:text-slate-navy transition-colors duration-200">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-semibold">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <span class="hidden sm:block font-medium">{{ $user->name }}</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>

                <!-- Dropdown -->
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-border opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="py-2">
                        <a href="#profile" class="block px-4 py-2 text-sm text-cool-gray hover:bg-off-white transition-colors">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <hr class="my-1 border-border">
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobileMenuDashboard" class="md:hidden hidden px-6 pb-4">
        <a href="#materi" class="block py-2 text-cool-gray hover:text-slate-navy">Materi</a>
        <a href="#eksplorasi" class="block py-2 text-cool-gray hover:text-slate-navy">Eksplorasi</a>
        <a href="#kenali-karier" class="block py-2 text-cool-gray hover:text-slate-navy">Kenali Karir</a>
        <a href="#bincang-karier" class="block py-2 text-cool-gray hover:text-slate-navy">Bincang Karir</a>
    </div>
</nav>