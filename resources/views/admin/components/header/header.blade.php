@php
    $pageTitle = $pageTitle ?? 'Dashboard';
    $addButtonText = $addButtonText ?? 'Tambah User';
    $addUserRoute = $addUserRoute ?? route('register');
    $stats = [
        [
            'label' => 'Total User',
            'count' => $userCount,
            'icon' => 'fas fa-users',
            'bg' => 'from-blue-500 to-blue-600',
            'textColor' => 'text-blue-100'
        ],
        [
            'label' => 'Admin',
            'count' => $adminCount,
            'icon' => 'fas fa-shield-alt',
            'bg' => 'from-green-500 to-green-600',
            'textColor' => 'text-green-100'
        ],
        [
            'label' => 'Siswa',
            'count' => $siswaCount,
            'icon' => 'fas fa-graduation-cap',
            'bg' => 'from-emerald-500 to-emerald-600',
            'textColor' => 'text-emerald-100'
        ],
    ];
    $roles = $roles ?? ['admin', 'siswa'];
@endphp

<!-- Mobile header -->
<div class="md:hidden flex justify-between items-center mb-4">
    <button onclick="toggleSidebar()" class="text-2xl text-slate-700 hover:text-blue-600 transition-colors">
        <i class="fas fa-bars"></i>
    </button>
    <div>
        <button class="px-3 py-2 bg-white/80 backdrop-blur-sm text-slate-700 hover:bg-white border border-slate-200 rounded-lg transition-all shadow-sm hover:shadow-md">
            <i class="fas fa-download"></i>
        </button>
        <a href="{{ $addUserRoute }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all shadow-lg">
            <i class="fas fa-user-plus mr-0 sm:mr-2"></i>
            <span class="hidden sm:inline">{{ $addButtonText }}</span>
        </a>
    </div>
</div>

<!-- Desktop Header -->
<div class="hidden md:flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">
            {{ $pageTitle }}
        </h1>
    </div>
    <div class="flex gap-2">
        <button class="px-4 py-2 bg-white/80 backdrop-blur-sm text-slate-700 hover:bg-white border border-slate-200 rounded-lg transition-all shadow-sm hover:shadow-md">
            <i class="fas fa-download mr-2"></i>
            Export
        </button>

        <a href="{{ $addUserRoute }}" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 rounded-lg transition-all shadow-lg hover:shadow-xl">
            <i class="fas fa-plus mr-2"></i>
            {{ $addButtonText }}
        </a>
    </div>
</div>

<!-- Enhanced Stats Cards -->
<div class="grid grid-cols-2 gap-4 md:grid-cols-4">
    @foreach ($stats as $stat)
        <div class="bg-gradient-to-br {{ $stat['bg'] }} text-white rounded-xl p-4 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="{{ $stat['textColor'] }} text-sm">{{ $stat['label'] }}</p>
                    <h3 class="text-2xl font-bold">{{ $stat['count'] }}</h3>
                </div>
                <div class="bg-white/20 p-3 rounded-lg">
                    <i class="{{ $stat['icon'] }} text-xl"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Search and Filter Section -->
<div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border-0 p-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="flex flex-col gap-4 md:flex-row md:items-center">
            <!-- Search Input -->
            <div class="relative flex-1 md:w-96">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="cari berdasarkan nama atau username"
                    class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                >
            </div>

            <!-- Role Filter -->
            <div class="flex gap-2">
                <div class="relative inline-block w-48">
                    <select id="roleFilter" class="appearance-none w-full px-4 py-2 pr-10 bg-white border border-gray-300 rounded-lg shadow-sm
                        focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition
                        cursor-pointer">
                        <option value="">Semua Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ strtolower($role) }}">{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-sm text-slate-600">
            <span id="resultCount">{{ $users->count() ?? 0 }}</span> pengguna ditemukan
        </div>
    </div>
</div>
