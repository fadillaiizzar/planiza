<aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-slate-navy text-white p-4 flex flex-col justify-between transition-all duration-300 ease-in-out z-40 transform md:translate-x-0 -translate-x-full md:translate-none">

    <!-- Atas: Profil + Toggle -->
    <div>
        <!-- Foto + Nama -->
        <div id="profileSection" class="flex flex-row items-center gap-3 mb-6 transition-all duration-300">
            <div id="profilePic" class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center transition-all duration-300 shrink-0">
                <span class="text-white font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
            </div>
            <div id="userName" class="font-medium text-lg text-left transition-all duration-300 origin-left whitespace-nowrap">
                {{ $user->name }}
            </div>
        </div>

        <!-- Tombol toggle sidebar -->
        <div class="hidden md:flex justify-start mb-6">
            <button onclick="toggleSidebarSize()" class="text-off-white hover:bg-off-white hover:text-slate-navy ml-2 p-2 rounded transition-all duration-300">
                <i id="sidebarToggleIcon" class="fas fa-angle-left text-base"></i>
            </button>
        </div>

        <!-- Navigasi -->
        <nav class="space-y-4" id="navWrapper">
            @php
                $sidebarItems = [
                    ['icon' => 'fa-home', 'label' => 'Dashboard', 'route' => 'admin.dashboard'],
                    ['icon' => 'fa-users', 'label' => 'User', 'route' => 'admin.user'],
                    ['icon' => 'fa-book', 'label' => 'Materi', 'route' => 'topik-materi.index'],
                    ['icon' => 'fa-globe', 'label' => 'Eksplorasi', 'route' => 'admin.dashboard'],
                    ['icon' => 'fa-briefcase', 'label' => 'Kenali Karier', 'route' => 'admin.dashboard'],
                    ['icon' => 'fa-leaf', 'label' => 'Kontribusi SDGs', 'route' => 'admin.kontribusi-sdgs'],
                    ['icon' => 'fa-comments', 'label' => 'Bincang Karier', 'route' => 'admin.dashboard'],
                ];
            @endphp

            @foreach ($sidebarItems as $item)
                <a href="{{ route($item['route']) }}" class="flex items-center p-2 rounded hover:bg-off-white hover:text-slate-navy transition-all duration-300 nav-item">
                    <div class="icon-wrapper w-7 flex items-center justify-start">
                        <i class="fas {{ $item['icon'] }} text-lg"></i>
                    </div>
                    <span class="sidebar-label text-md transition-all duration-300 origin-left whitespace-nowrap">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </div>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="flex items-center w-full p-2 rounded hover:bg-red-100 text-red-400 hover:text-red-600 transition-all duration-300 nav-item">
            <div class="icon-wrapper w-7 h-7 flex justify-start items-center">
                <i class="fas fa-sign-out-alt text-lg"></i>
            </div>
            <span class="sidebar-label text-md transition-all duration-300 origin-left whitespace-nowrap">Logout</span>
        </button>
    </form>
</aside>
