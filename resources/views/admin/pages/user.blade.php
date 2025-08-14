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
                'stats' => [
                    ['label' => 'Total User', 'count' => $userCount, 'icon' => 'fas fa-users', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                    ['label' => 'Admin', 'count' => $users->where('role.nama_role', 'admin')->count(), 'icon' => 'fas fa-shield-alt', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                    ['label' => 'Siswa', 'count' => $users->where('role.nama_role', 'siswa')->count(), 'icon' => 'fas fa-graduation-cap', 'bg' => 'from-emerald-500 to-emerald-600', 'textColor' => 'text-emerald-100'],
                ],
                'filterOptions' => [
                    ['label' => 'Admin', 'value' => 'admin'],
                    ['label' => 'Siswa', 'value' => 'siswa'],
                ],
                'searchPlaceholder' => 'Cari berdasarkan nama atau username',
                'itemCount' => $users->count(),
            ])

            <!-- Enhanced Users Table -->
            <section class="bg-white rounded-xl shadow p-6 mt-6">
                <h3 class="text-xl font-bold mb-6 text-slate-navy">Daftar User</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm table-auto">
                        <thead class="bg-off-white border-b border-border-gray">
                            <tr>
                                <th class="p-4 font-semibold text-slate-navy">ID</th>
                                <th class="p-4 font-semibold text-slate-navy">Pengguna</th>
                                <th class="p-4 font-semibold text-slate-navy">Username</th>
                                <th class="p-4 font-semibold text-slate-navy">Password</th>
                                <th class="p-4 font-semibold text-slate-navy">Role</th>
                                <th class="p-4 font-semibold text-slate-navy">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                            <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors user-row"
                                data-name="{{ strtolower($u->name) }}"
                                data-username="{{ strtolower($u->username) }}"
                                data-role="{{ strtolower($u->role->nama_role ?? '') }}"
                            >
                                <td class="p-4">{{ $u->id }}</td>
                                <td class="p-4 font-medium text-slate-navy">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $u->name)[1] ?? '', 0, 1)) }}
                                        </div>
                                        <span>{{ $u->name }}</span>
                                    </div>
                                </td>
                                <td class="p-4">{{ $u->username }}</td>
                                <td class="p-4">
                                    <span class="text-slate-600 font-mono text-xs px-2 py-1 rounded">
                                        {{ \Illuminate\Support\Str::limit($u->password, 10) }}
                                    </span>
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
                                <td class="p-4 relative overflow-visible">
                                    <button onclick="toggleDropdown({{ $u->id }})"
                                        class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                        <i class="fas fa-cog text-cool-gray"></i>
                                    </button>

                                    <div id="dropdown-{{ $u->id }}" class="hidden absolute right-12 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">
                                        <a href="{{ route('admin.users.detail', $u->id) }}"
                                            class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                            <i class="fas fa-eye w-5 h-5"></i>
                                            <span>Detail</span>
                                        </a>
                                        <div class="border-t border-border-gray"></div>
                                        <button type="button" onclick="showDeleteModal({{ $u->id }}, '{{ addslashes($u->name) }}')"
                                            class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base border-none bg-transparent cursor-pointer">
                                            <i class="fas fa-trash-alt w-5 h-5"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
                {{ $users->links() }}
            </div>
        </div>
    </main>

    <!-- Modal Create -->
    <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        @include('auth.register', [
            'roles' => $roles,
            'kelas' => $kelas,
            'jurusans' => $jurusans,
            'rencanas' => $rencanas,
        ])
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 shadow-xl">
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Hapus User</h3>
            <p class="text-slate-600 mb-6">
                Apakah Anda yakin ingin menghapus <span id="deleteUserName" class="font-bold"></span>?
                Tindakan ini tidak dapat dibatalkan
            </p>

            <form id="deleteForm" method="POST" class="flex justify-center gap-2">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 hover:underline">
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
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Inisialisasi filter search & select role
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

        // Toggle dropdown action button
        function toggleDropdown(id) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(drop => {
                if (drop.id === `dropdown-${id}`) {
                    drop.classList.toggle('hidden');
                } else {
                    drop.classList.add('hidden');
                }
            });
        }

        // Tampilkan modal hapus user
        function showDeleteModal(userId, userName) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteUserName').textContent = userName;
            const form = document.getElementById('deleteForm');
            form.action = `/admin/users/${userId}`;
        }

        // Tutup modal hapus user
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Klik di luar modal dan dropdown, tutup mereka
        document.addEventListener('click', function (e) {
            // Tutup dropdown jika klik di luar tombol dan dropdown
            if (!e.target.closest('[id^="dropdown-"]') && !e.target.closest('button[onclick^="toggleDropdown"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
            }
            // Tutup modal jika klik di luar modal konten
            const modal = document.getElementById('deleteModal');
            if (!modal.classList.contains('hidden') && e.target === modal) {
                closeDeleteModal();
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            initializeFilters();
        });
    </script>
@endpush
