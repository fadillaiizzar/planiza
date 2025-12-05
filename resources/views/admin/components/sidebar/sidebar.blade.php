<aside id="sidebar"
    class="fixed md:static inset-y-0 left-0 w-64 bg-slate-navy text-white p-4
           flex flex-col transition-all duration-300 ease-in-out z-40
           transform md:translate-x-0 -translate-x-full md:translate-none
           h-screen overflow-hidden">

    <!-- HEADER: Foto + Nama + Toggle -->
    <div class="shrink-0">
        <div id="profileSection" class="flex flex-row items-center gap-3 mb-6">
            <div id="profilePic" class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center">
                <span class="text-white font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
            </div>
            <div id="userName" class="font-medium text-lg whitespace-nowrap">
                {{ $user->name }}
            </div>
        </div>

        <div class="hidden md:flex justify-start mb-6">
            <button onclick="toggleSidebarSize()"
                class="text-off-white hover:bg-off-white hover:text-slate-navy ml-2 p-2 rounded">
                <i id="sidebarToggleIcon" class="fas fa-angle-left"></i>
            </button>
        </div>
    </div>

    <!-- NAV -->
    <nav id="navWrapper" class="flex-1 overflow-y-auto space-y-4 pr-1">
        @php
            $sidebarItems = [
                ['icon' => 'fa-home', 'label' => 'Dashboard', 'route' => 'admin.dashboard'],
                ['icon' => 'fa-users', 'label' => 'User', 'route' => 'admin.user.index'],
                ['icon' => 'fa-book', 'label' => 'Pembelajaran', 'route' => 'admin.pembelajaran.index'],
                ['icon' => 'fa-tools', 'label' => 'Eksplorasi Profesi', 'route' => 'admin.eksplorasi-profesi.index'],
                ['icon' => 'fa-user-tie', 'label' => 'Kenali Profesi', 'route' => 'admin.kenali-profesi.index'],
                ['icon' => 'fa-tools', 'label' => 'Eksplorasi Jurusan', 'route' => 'admin.eksplorasi-jurusan.index'],
                ['icon' => 'fa-user-graduate', 'label' => 'Kenali Jurusan', 'route' => 'admin.kenali-jurusan.index'],
                ['icon' => 'fa-leaf', 'label' => 'SDGs', 'route' => 'admin.sdgs.index'],
                ['icon' => 'fa-comments', 'label' => 'Bincang Karier', 'route' => 'admin.bincang-karier.index'],
            ];
        @endphp

        @foreach ($sidebarItems as $item)
            <a href="{{ route($item['route']) }}"
               class="flex items-center p-2 rounded transition duration-300
               {{ request()->routeIs($item['route'])
                     ? 'bg-white text-slate-navy font-semibold'
                     : 'hover:bg-off-white hover:text-slate-navy' }}">

                <div class="icon-wrapper w-7 flex items-center justify-start">
                    <i class="fas {{ $item['icon'] }} text-lg"></i>
                </div>

                <span class="sidebar-label whitespace-nowrap">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}" class="shrink-0 mt-4">
        @csrf
        <button type="submit"
            class="flex items-center w-full p-2 rounded hover:bg-red-100 text-red-400 hover:text-red-600">
            <div class="icon-wrapper w-7">
                <i class="fas fa-sign-out-alt text-lg"></i>
            </div>
            <span class="sidebar-label whitespace-nowrap">Logout</span>
        </button>
    </form>
</aside>
