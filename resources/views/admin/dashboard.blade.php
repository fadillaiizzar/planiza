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
            <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-slate-navy text-white p-4 flex flex-col justify-between transition-all duration-300 ease-in-out z-40">

                <!-- Atas: Profil + Toggle -->
                <div>

                    <!-- Foto + Nama -->
                    <div id="profileSection" class="flex items-center space-x-3 mb-6 px-2 transition-all duration-300">
                        <div id="profilePic" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center transition-all duration-300">
                            <span class="text-white font-semibold text-base">{{ substr($user->name, 0, 1) }}</span>
                        </div>
           
                        <div id="userName" class="font-medium text-xl text-left transition-all duration-300">
                            {{ $user->name }}
                        </div>
                    </div>

                    <!-- Tombol toggle sidebar -->
                    <div class="flex justify-start md:justify-start mb-6 transition-all duration-300">
                        <button onclick="toggleSidebarSize()" class="text-white ml-5">
                            <i id="sidebarToggleIcon" class="fas fa-angle-left text-base"></i>
                        </button>
                    </div>

                    <!-- Navigasi -->
                    <nav class="space-y-4">
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
                            <a href="#" class="flex items-center p-2 rounded hover:bg-off-white hover:text-slate-navy transition">
                                <!-- Bungkus icon dengan lebar tetap dan center -->
                                <div class="w-7 flex justify-center items-center">
                                    <i class="fas {{ $item['icon'] }} text-lg"></i>
                                </div>
                                <span class="sidebar-label text-md ml-3">{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Yakin mau logout?');">
                    @csrf
                    <button type="submit" class="flex items-center p-2 rounded hover:bg-red-100 text-red-400 hover:text-red-600 transition space-x-3 w-full">
                        <div class="w-7 h-7 flex justify-center items-center">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                        </div>
                        <span class="sidebar-label text-md ml-3">Logout</span>
                    </button>
                </form>
            </aside>

            <!-- Overlay (mobile) -->
            <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

            <!-- Main -->
            <main class="flex-1 p-6">
                <!-- Topbar mobile toggle + action -->
                <div class="md:hidden flex justify-between items-center mb-4">
                    <button onclick="toggleSidebar()" class="text-2xl">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a href="{{ route('register') }}" class="text-xl text-slate-navy hover:text-blue-600">
                        <i class="fas fa-user-plus"></i>
                    </a>
                </div>

                <!-- Header (desktop) -->
                <div class="hidden md:flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Selamat Datang, {{ $user->name }} 👋</h2>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-slate-navy hover:bg-slate-navy hover:text-white border border-slate-navy rounded transition">
                        ➕ Tambah Akun Baru
                    </a>
                </div>

                <!-- Overview -->
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

                <!-- Aktivitas Terbaru -->
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
                                <td class="p-2 text-sm">{{ $log->user->name }}</td>
                                <td class="p-2 text-sm">{{ $log->aktivitas }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>

        <script>
            function toggleSidebarSize() {
                const sidebar = document.getElementById('sidebar');
                const isCollapsed = sidebar.classList.toggle('w-20');
                sidebar.classList.toggle('w-64', !isCollapsed);

                // Nama user
                const userName = document.getElementById('userName');
                if (userName) {
                    userName.classList.toggle('hidden', isCollapsed);
                }

                // Semua label sidebar
                document.querySelectorAll('.sidebar-label').forEach(label => {
                    label.classList.toggle('hidden', isCollapsed);
                });

                // Ubah posisi & ukuran foto profil
                const profileSection = document.getElementById('profileSection');
                const profilePic = document.getElementById('profilePic');

                if (isCollapsed) {
                    profileSection.classList.remove('flex-row', 'space-x-3');
                    profileSection.classList.add('flex-col', 'items-center', 'space-y-2');
                    profilePic.classList.remove('w-10', 'h-10');
                    profilePic.classList.add('w-12', 'h-12');
                } else {
                    profileSection.classList.remove('flex-col', 'items-center', 'space-y-2');
                    profileSection.classList.add('flex-row', 'items-center', 'space-x-3');
                    profilePic.classList.remove('w-12', 'h-12');
                    profilePic.classList.add('w-10', 'h-10');
                }

                // Ganti ikon toggle
                const icon = document.getElementById('sidebarToggleIcon');
                icon.classList.toggle('fa-angle-left', !isCollapsed);
                icon.classList.toggle('fa-angle-right', isCollapsed);
            }
        </script>
    </body>
</html>