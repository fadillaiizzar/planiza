<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="font-poppins bg-off-white text-slate-navy">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
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
                            ['icon' => 'fa-home', 'label' => 'Dashboard'],
                            ['icon' => 'fa-users', 'label' => 'User'],
                            ['icon' => 'fa-book', 'label' => 'Materi'],
                            ['icon' => 'fa-globe', 'label' => 'Eksplorasi'],
                            ['icon' => 'fa-briefcase', 'label' => 'Kenali Karier'],
                            ['icon' => 'fa-leaf', 'label' => 'Kontribusi SDGs'],
                            ['icon' => 'fa-comments', 'label' => 'Bincang Karier'],
                        ];
                    @endphp

                    @foreach ($sidebarItems as $item)
                        <a href="#" class="flex items-center p-2 rounded hover:bg-off-white hover:text-slate-navy transition-all duration-300 nav-item">
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

        <!-- Overlay (mobile) -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

        <!-- Main -->
        <main class="flex-1 p-6">
            <div class="md:hidden flex justify-between items-center mb-4">
                <button onclick="toggleSidebar()" class="text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ route('register') }}" class="text-xl text-slate-navy hover:text-blue-600">
                    <i class="fas fa-user-plus"></i>
                </a>
            </div>

            <div class="hidden md:flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Selamat Datang, {{ $user->name }} 👋</h2>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-slate-navy hover:bg-slate-navy hover:text-white border border-slate-navy rounded transition">
                    ➕ Tambah Akun 
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white shadow rounded-lg p-4">
                    <p class="text-cool-gray">Total User</p>
                    <h3 class="text-2xl font-bold">{{ $userCount }}</h3>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <p class="text-cool-gray">Jumlah Materi</p>
                    <h3 class="text-2xl font-bold">{{ $materiCount }}</h3>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <p class="text-cool-gray">Jumlah Eksplorasi</p>
                    <h3 class="text-2xl font-bold">{{ $eksplorasiCount }}</h3>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-xl font-semibold mb-4">Aktivitas Terbaru</h3>
                <table class="w-full table-auto text-left">
                    <thead>
                        <tr class="border-b border-border-gray text-cool-gray">
                            <th class="p-2">Waktu</th>
                            <th class="p-2">Nama</th>
                            <th class="p-2">Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aktivitas as $log)
                        <tr class="border-b hover:bg-off-white">
                            <td class="p-2 text-sm">{{ $log->created_at->format('d M Y H:i') }}</td>
                            <td class="p-2 text-sm">{{ $log->user?->name ?? '-' }}</td>
                            <td class="p-2 text-sm">{{ $log->aktivitas }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- JS: Sidebar Behavior -->
    <script>
        function toggleSidebarSize() {
            const sidebar = document.getElementById('sidebar');
            const isCollapsed = sidebar.classList.toggle('w-20');
            sidebar.classList.toggle('w-64', !isCollapsed);

            const profileSection = document.getElementById('profileSection');
            const userName = document.getElementById('userName');

            if (isCollapsed) {
                profileSection.classList.replace('gap-3', 'gap-2');
                userName.classList.add('opacity-0', 'w-0', 'overflow-hidden');
            } else {
                profileSection.classList.replace('gap-2', 'gap-3');
                userName.classList.remove('opacity-0', 'w-0', 'overflow-hidden');
            }

            document.querySelectorAll('.sidebar-label').forEach(label => {
                label.classList.toggle('opacity-0', isCollapsed);
                label.classList.toggle('w-0', isCollapsed);
                label.classList.toggle('overflow-hidden', isCollapsed);
            });

            document.querySelectorAll('.icon-wrapper').forEach(wrapper => {
                wrapper.classList.toggle('justify-center', isCollapsed);
                wrapper.classList.toggle('justify-start', !isCollapsed);
            });

            const icon = document.getElementById('sidebarToggleIcon');
            icon.classList.toggle('fa-angle-left', !isCollapsed);
            icon.classList.toggle('fa-angle-right', isCollapsed);
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            const isOpen = sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
