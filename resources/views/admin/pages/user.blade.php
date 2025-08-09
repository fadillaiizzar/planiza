@extends('layouts.admin')

@section('title', 'User Admin - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <div class="mx-auto max-w-7xl space-y-6">

           @include('admin.components.header.header', [
                'pageTitle' => 'User Management',
                'addButtonText' => 'Tambah User',
                'addUserRoute' => route('register'),
                'userCount' => $userCount,
                'users' => $users,
                'stats' => [
                    ['label' => 'Total User', 'count' => $userCount, 'icon' => 'fas fa-users', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                    ['label' => 'Admin', 'count' => $users->where('role.nama_role', 'admin')->count(), 'icon' => 'fas fa-shield-alt', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                    ['label' => 'Siswa', 'count' => $users->where('role.nama_role', 'siswa')->count(), 'icon' => 'fas fa-graduation-cap', 'bg' => 'from-emerald-500 to-emerald-600', 'textColor' => 'text-emerald-100'],
                ],
                'roles' => ['admin', 'siswa']
            ])

            <!-- Enhanced Users Table -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border-0 overflow-visible">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-xl font-semibold text-slate-800">Daftar User</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto text-left text-sm" id="usersTable">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-200">
                                <th class="p-4 font-semibold text-slate-700">ID</th>
                                <th class="p-4 font-semibold text-slate-700">Pengguna</th>
                                <th class="p-4 font-semibold text-slate-700">Username</th>
                                <th class="p-4 font-semibold text-slate-700">Password</th>
                                <th class="p-4 font-semibold text-slate-700">Role</th>
                                <th class="p-4 font-semibold text-slate-700 text-center ">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors user-row" data-role="{{ strtolower($u->role->nama_role ?? '') }}" data-name="{{ strtolower($u->name) }}" data-username="{{ strtolower($u->username) }}">
                                <td class="p-4 text-slate-600">{{ $u->id }}</td>
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $u->name)[1] ?? '', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $u->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700">{{ $u->username }}</td>
                                <td class="p-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-slate-600 font-mono text-xs px-2 py-1 rounded">
                                            {{ \Illuminate\Support\Str::limit($u->password, 10) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    @php
                                        $roleColors = [
                                            'admin' => 'bg-gradient-to-r from-purple-500 to-purple-600 text-white',
                                            'guru' => 'bg-gradient-to-r from-blue-500 to-blue-600 text-white',
                                            'siswa' => 'bg-gradient-to-r from-green-500 to-green-600 text-white'
                                        ];
                                        $roleIcons = [
                                            'admin' => 'fas fa-shield-alt',
                                            'guru' => 'fas fa-chalkboard-teacher',
                                            'siswa' => 'fas fa-graduation-cap'
                                        ];
                                        $roleName = strtolower($u->role->nama_role ?? '');
                                    @endphp

                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium {{ $roleColors[$roleName] ?? 'bg-gray-500 text-white' }}">
                                        <i class="{{ $roleIcons[$roleName] ?? 'fas fa-user' }}"></i>
                                        {{ $u->role->nama_role ?? '-' }}
                                    </span>
                                </td>
                                <td class="p-4 text-center relative overflow-visible"> <!-- pastikan overflow visible -->
                                    <button onclick="toggleDropdown({{ $u->id }})"
                                            class="p-2 rounded-lg hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                        <i class="fas fa-cog text-slate-600"></i>
                                    </button>

                                    <!-- Dropdown -->
                                    <div id="dropdown-{{ $u->id }}" class="hidden absolute right-8 mt-2 bg-white border border-slate-200 rounded-lg shadow-xl z-20 min-w-[180px] w-auto overflow-visible">
                                        <a href="{{ route('admin.users.detail', $u->id) }}" class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                            <i class="fas fa-eye w-5 h-5"></i>
                                            <span>Detail User</span>
                                        </a>

                                        <div class="border-t border-slate-100"></div>

                                        <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" onsubmit="return confirm('Yakin hapus {{ $u->name }}?')" class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="showDeleteModal({{ $u->id }}, '{{ $u->name }}')" class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base border-none bg-transparent cursor-pointer">
                                                <i class="fas fa-trash-alt w-5 h-5"></i>
                                                <span>Hapus User</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Konfirmasi Delete -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 shadow-xl">
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Hapus User</h3>
            <p class="text-slate-600 mb-6">
                Apakah Anda yakin ingin menghapus <span id="deleteUserName" class="font-bold"></span>?
                Tindakan ini tidak dapat dibatalkan
            </p>

            <!-- Action akan diubah via JavaScript -->
            <form id="deleteForm" method="POST" class="flex justify-center gap-2">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                    Hapus
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Existing functions
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

        function toggleDropdown(id) {
            // Tutup semua dropdown dulu
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                if (el.id !== `dropdown-${id}`) el.classList.add('hidden');
            });
            // Toggle dropdown yang diklik
            const dropdown = document.getElementById(`dropdown-${id}`);
            dropdown.classList.toggle('hidden');
        }

        // Enhanced search and filter functionality
        function initializeFilters() {
            const searchInput = document.getElementById('searchInput');
            const roleFilter = document.getElementById('roleFilter');
            const resultCount = document.getElementById('resultCount');
            const userRows = document.querySelectorAll('.user-row');

            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedRole = roleFilter.value.toLowerCase();
                let visibleCount = 0;

                userRows.forEach(row => {
                    const name = row.dataset.name;
                    const username = row.dataset.username;
                    const role = row.dataset.role;

                    const matchesSearch = name.includes(searchTerm) || username.includes(searchTerm);
                    const matchesRole = !selectedRole || role === selectedRole;

                    if (matchesSearch && matchesRole) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                resultCount.textContent = visibleCount;
            }

            searchInput.addEventListener('input', filterUsers);
            roleFilter.addEventListener('change', filterUsers);
        }

        function togglePassword(userId) {
            // Placeholder for password toggle functionality
            alert('Toggle password visibility for user ID: ' + userId);
        }

        // Klik di luar dropdown -> tutup
        document.addEventListener('click', function (e) {
            if (!e.target.closest('[id^="dropdown-"]') && !e.target.closest('button')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
            }
        });

        // Initialize filters when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initializeFilters();
        });

        function showDeleteModal(userId, userName) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteUserName').textContent = userName;

            // Set action sesuai route admin.users.delete
            const form = document.getElementById('deleteForm');
            form.action = `/admin/users/${userId}`;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endpush
