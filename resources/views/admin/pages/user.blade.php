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
                    ['label' => 'Administrator', 'count' => $administratorCount, 'icon' => 'fas fa-crown', 'bg' => 'from-red-500 to-red-600', 'textColor' => 'text-red-100'],
                    ['label' => 'Admin', 'count' => $adminCount, 'icon' => 'fas fa-shield-alt', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                    ['label' => 'Siswa', 'count' => $siswaCount, 'icon' => 'fas fa-graduation-cap', 'bg' => 'from-emerald-500 to-emerald-600', 'textColor' => 'text-emerald-100'],
                ],
                'filterOptions' => [
                    ['label' => 'Administrator', 'value' => 'administrator'],
                    ['label' => 'Admin', 'value' => 'admin'],
                    ['label' => 'Siswa', 'value' => 'siswa'],
                ],
                'searchPlaceholder' => 'Cari berdasarkan nama atau username',
                'itemCount' => $users->count(),
            ])

            <!-- Enhanced Users Table -->
            <section class="bg-white rounded-xl shadow p-6 mt-6">
                <x-h3>Daftar User</x-h3>
                <div class="overflow-x-auto scrollbar-none">
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
                            @forelse ($users as $u)
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
                                                'administrator' => 'bg-gradient-to-r from-red-500 to-red-600 text-white',
                                                'admin'         => 'bg-gradient-to-r from-purple-500 to-purple-600 text-white',
                                                'siswa'         => 'bg-gradient-to-r from-green-500 to-green-600 text-white'
                                            ];

                                            $roleIcons = [
                                                'administrator' => 'fas fa-crown',
                                                'admin'         => 'fas fa-shield-alt',
                                                'siswa'         => 'fas fa-graduation-cap'
                                            ];
                                            $roleName = strtolower($u->role->nama_role ?? '');
                                        @endphp
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium {{ $roleColors[$roleName] ?? 'bg-gray-500 text-white' }}">
                                            <i class="{{ $roleIcons[$roleName] ?? 'fas fa-user' }}"></i>
                                            {{ $u->role->nama_role ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="p-4 relative overflow-visible">
                                        <!-- Tombol toggle -->
                                        <button onclick="toggleDropdown({{ $u->id }})"
                                            class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                            <i class="fas fa-cog text-cool-gray"></i>
                                        </button>

                                        <!-- Dropdown -->
                                        <div id="dropdown-{{ $u->id }}"
                                            class="hidden absolute right-12 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">

                                            <!-- Detail -->
                                            <a href="{{ route('admin.user.show', $u->id) }}"
                                                class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                                <i class="fas fa-eye w-5 h-5"></i>
                                                <span>Detail</span>
                                            </a>

                                            <!-- Hapus (jangan tampilkan jika Administrator) -->
                                            @if($u->role->nama_role !== 'Administrator')
                                                <!-- Edit -->
                                                <div class="border-t border-border-gray"></div>
                                                <button type="button" onclick="showEditUser({{ $u->id }})"
                                                    class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base border-none bg-transparent cursor-pointer">
                                                    <i class="fas fa-edit w-5 h-5"></i>
                                                    <span>Edit</span>
                                                </button>

                                                <div class="border-t border-border-gray"></div>
                                                <button type="button"
                                                    onclick="showDeleteModal({{ $u->id }}, '{{ addslashes($u->name) }}', '{{ route('admin.user.destroy', $u->id) }}')"
                                                    class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base border-none bg-transparent cursor-pointer">
                                                    <i class="fas fa-trash-alt w-5 h-5"></i>
                                                    <span>Hapus</span>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <x-empty-state
                                    colspan="5"
                                    icon="fas fa-user-slash"
                                    message="Belum ada user. Tambahkan data"
                                    button="true"
                                    buttonAction="openModalUser()"
                                    buttonText="+ Tambah User"
                                />
                            @endforelse

                            <x-no-data-row />
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

    <!-- Modal User -->
    <div id="modalEditUser" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div id="modalContentEditUser" class="w-full mx-auto flex items-center justify-center"></div>
    </div>

    <!-- Modal Konfirmasi Delete User -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-2xl border border-[#CBD5E1] relative overflow-hidden">
            <!-- Decorative header -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-red-600"></div>

            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-[#1E293B] mb-2">Hapus User</h3>
                <p class="text-[#64748B] mb-6 leading-relaxed text-sm sm:text-base">
                    Apakah Anda yakin ingin menghapus user bernama
                    <span id="deleteUserName"></span> ?
                    <br>
                    <span class="text-sm text-red-500 mt-2 block">Tindakan ini tidak dapat dibatalkan</span>
                </p>

                <form id="deleteForm" method="POST" class="flex flex-row justify-center gap-5">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeDeleteModal()"
                            class="hover:underline text-[#64748B] transition-all duration-200 font-medium w-full sm:w-auto">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-6 py-2 rounded-full bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg w-full sm:w-auto">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initializeFilters();
        });

        // Modal Popup Edit User
        function showEditUser(id) {
            fetch(`/admin/users/${id}/edit`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('modalContentEditUser').innerHTML = html;
                    initEditUserForm();
                    openModalEditUser();
            });
        }

        // jika role siswa akan menampilkan form siswa
        function initEditUserForm() {
            const roleSelect = document.querySelector('#modalEditUser #roleSelect');
            const siswaFields = document.querySelector('#modalEditUser #siswaFields');

            if (!roleSelect || !siswaFields) return;

            function toggleSiswaFields() {
                const selectedText = roleSelect.options[roleSelect.selectedIndex].text;
                if (selectedText === 'Siswa') {
                    siswaFields.classList.remove('hidden');
                } else {
                    siswaFields.classList.add('hidden');
                }
            }

            // cek awal
            toggleSiswaFields();

            // kalau dropdown berubah
            roleSelect.addEventListener('change', toggleSiswaFields);
        }

        function openModalEditUser() {
            const modal = document.getElementById('modalEditUser');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeModalEditUser() {
            const modal = document.getElementById('modalEditUser');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        // Modal Popup Hapus User
        function showDeleteModal(id, name, action) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteUserName').textContent = name;
            const form = document.getElementById('deleteForm');
            form.action = action;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.addEventListener('click', function (e) {
            if (!e.target.closest('[id^="dropdown-"]') && !e.target.closest('button[onclick^="toggleDropdown"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
            }

            const modal = document.getElementById('deleteModal');
            if (!modal.classList.contains('hidden') && e.target === modal) {
                closeDeleteModal();
            }
        });
    </script>
@endpush
