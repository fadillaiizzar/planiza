@extends('layouts.admin')

@section('title', 'User Admin - Planiza')

@section('content')
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
            <h2 class="text-2xl font-semibold">User</h2>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-slate-navy hover:bg-slate-navy hover:text-white border border-slate-navy rounded transition">
                Tambah Akun
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-cool-gray">Total User</p>
                <h3 class="text-2xl font-bold">{{ $userCount }}</h3>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-xl font-semibold mb-4">Daftar User</h3>
            <table class="w-full table-auto text-left text-sm">
                <thead>
                    <tr class="border-b border-border-gray text-cool-gray">
                        <th class="p-2 w-12">ID</th>
                        <th class="p-2 w-1/4">Nama</th>
                        <th class="p-2 w-1/5">Username</th>
                        <th class="p-2 w-1/5">Password</th>
                        <th class="p-2 w-1/6">Role</th>
                        <th class="p-2 text-center w-16">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                    <tr class="border-b hover:bg-off-white">
                        <td class="p-2">{{ $u->id }}</td>
                        <td class="p-2 font-medium">{{ $u->name }}</td>
                        <td class="p-2">{{ $u->username }}</td>
                        <td class="p-2 truncate" title="{{ $u->password }}">
                            {{ \Illuminate\Support\Str::limit($u->password, 10) }}
                        </td>
                        <td class="p-2">{{ $u->role->nama_role ?? '-' }}</td>
                        <td class="p-2 text-center relative">
                            <!-- Tombol utama -->
                            <button onclick="toggleDropdown({{ $u->id }})"
                                class="p-1 rounded hover:bg-gray-100 focus:outline-none">
                                <i class="fas fa-cog"></i>
                            </button>

                            <!-- Dropdown aksi -->
                            <div id="dropdown-{{ $u->id }}"
                                class="hidden absolute right-0 mt-2 bg-white border border-gray-200 rounded shadow-lg z-10 flex flex-col text-left">
                                @if($u->role->nama_role === 'siswa')
                                    <button onclick="alert('Detail Siswa: {{ $u->name }}')"
                                        class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2 text-blue-500">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                @endif
                                <button onclick="alert('Edit Data: {{ $u->name }}')"
                                    class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2 text-yellow-500">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button onclick="confirm('Yakin hapus {{ $u->name }}?')"
                                    class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2 text-red-500">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </main>
@endsection

@push('scripts')
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

    function toggleDropdown(id) {
        // Tutup semua dropdown dulu
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            if (el.id !== `dropdown-${id}`) el.classList.add('hidden');
        });

        // Toggle dropdown yang diklik
        const dropdown = document.getElementById(`dropdown-${id}`);
        dropdown.classList.toggle('hidden');
    }

    // Klik di luar dropdown -> tutup
    document.addEventListener('click', function (e) {
        if (!e.target.closest('[id^="dropdown-"]') && !e.target.closest('button')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
        }
    });
</script>
@endpush
