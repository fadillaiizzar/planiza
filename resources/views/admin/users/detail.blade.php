<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit User - {{ $user->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="font-poppins bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md border border-gray-200 py-8 shadow-xl rounded-2xl bg-white">
        <!-- Header with title and edit button -->
        <div class="flex justify-between items-center mb-6 px-6">
            <button id="backBtn" type="button" class="text-slate-600 hover:text-slate-800 transition-colors font-semibold flex items-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <h1 id="headerTitle" class="text-2xl font-semibold text-slate-800 ml-3 flex-1 text-left truncate">Detail User</h1>
            <button
                id="editToggleBtn"
                type="button"
                class="text-yellow-500 hover:text-yellow-600 text-xl font-semibold p-1"
                aria-label="Edit User"
                title="Edit User"
            >
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
        </div>

        @if(session('success'))
            <div class="mb-6 px-6 py-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6 px-6" id="editForm">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $user->name) }}"
                    disabled
                    class="w-full px-4 py-3 border rounded-lg text-slate-900 placeholder-slate-400
                    focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                    @error('name') border-red-500 @enderror"
                />
                @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    value="{{ old('username', $user->username) }}"
                    disabled
                    class="w-full px-4 py-3 border rounded-lg text-slate-900 placeholder-slate-400
                    focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                    @error('username') border-red-500 @enderror"
                />
                @error('username')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role_id" class="block text-sm font-medium text-slate-700 mb-2">Role</label>
                <select
                    name="role_id"
                    id="role_id"
                    onchange="toggleSiswaFields()"
                    disabled
                    class="w-full px-4 py-3 border rounded-lg text-slate-900
                    focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                    @error('role_id') border-red-500 @enderror"
                >
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" @if(old('role_id', $user->role_id) == $role->id) selected @endif>{{ $role->nama_role }}</option>
                    @endforeach
                </select>
                @error('role_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                <input
                    type="password"
                    value="********"
                    disabled
                    readonly
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed text-gray-500"
                />
                <p class="mt-1">
                    <button
                        id="resetPasswordBtn"
                        type="button"
                        onclick="showResetPasswordModal()"
                        class="text-gray-400 cursor-not-allowed text-sm font-medium"
                        disabled
                    >
                        Reset Password
                    </button>
                </p>
            </div>

            <div id="siswaFields" style="display:none;">
                <div class="mb-4">
                    <label for="kelas_id" class="block text-sm font-medium text-slate-700 mb-2">Kelas</label>
                    <select
                        name="kelas_id"
                        id="kelas_id"
                        disabled
                        class="w-full px-4 py-3 border rounded-lg text-slate-900
                        focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                        @error('kelas_id') border-red-500 @enderror"
                    >
                        <option value="">-- Pilih Kelas --</option>
                        @foreach(\App\Models\Kelas::all() as $kelas)
                            <option value="{{ $kelas->id }}" @if(old('kelas_id', $siswa->kelas_id ?? '') == $kelas->id) selected @endif>{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="jurusan_id" class="block text-sm font-medium text-slate-700 mb-2">Jurusan</label>
                    <select
                        name="jurusan_id"
                        id="jurusan_id"
                        disabled
                        class="w-full px-4 py-3 border rounded-lg text-slate-900
                        focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                        @error('jurusan_id') border-red-500 @enderror"
                    >
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach(\App\Models\Jurusan::all() as $jurusan)
                            <option value="{{ $jurusan->id }}" @if(old('jurusan_id', $siswa->jurusan_id ?? '') == $jurusan->id) selected @endif>{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                    @error('jurusan_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="rencana_id" class="block text-sm font-medium text-slate-700 mb-2">Rencana</label>
                    <select
                        name="rencana_id"
                        id="rencana_id"
                        disabled
                        class="w-full px-4 py-3 border rounded-lg text-slate-900
                        focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                        @error('rencana_id') border-red-500 @enderror"
                    >
                        <option value="">-- Pilih Rencana --</option>
                        @foreach(\App\Models\Rencana::all() as $rencana)
                            <option value="{{ $rencana->id }}" @if(old('rencana_id', $siswa->rencana_id ?? '') == $rencana->id) selected @endif>{{ $rencana->nama_rencana }}</option>
                        @endforeach
                    </select>
                    @error('rencana_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="no_hp" class="block text-sm font-medium text-slate-700 mb-2">No HP</label>
                    <input
                        type="text"
                        name="no_hp"
                        id="no_hp"
                        value="{{ old('no_hp', $siswa->no_hp ?? '') }}"
                        disabled
                        class="w-full px-4 py-3 border rounded-lg text-slate-900 placeholder-slate-400
                        focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors
                        @error('no_hp') border-red-500 @enderror"
                    />
                    @error('no_hp')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex space-x-3">
                <button
                    type="submit"
                    id="saveBtn"
                    class="w-full bg-slate-700 hover:bg-slate-800 text-white font-semibold py-3 rounded-lg transition-colors duration-200 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 hidden"
                >
                    Simpan
                </button>
                <button
                    type="button"
                    id="cancelBtn"
                    class="w-full border border-gray-300 rounded-lg py-3 text-center hover:bg-gray-100 hidden"
                >
                    Batal
                </button>
            </div>
        </form>
    </div>

    {{-- Modal Reset Password --}}
    <div id="resetPasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-md w-96">
            <h3 class="text-lg font-bold mb-4">Reset Password</h3>

            {{-- Opsi Reset Password --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Pilih Metode Reset</label>
                <select id="resetType" class="border rounded w-full p-2" onchange="toggleCustomPassword()">
                    <option value="default">Default Password (12345678)</option>
                    <option value="custom">Custom Password</option>
                </select>
            </div>

            <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST">
                @csrf

                {{-- Field Custom Password --}}
                <div id="customPasswordFields" class="hidden">
                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="border rounded w-full p-2">
                    </div>
                    <div class="mb-3">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="border rounded w-full p-2">
                    </div>
                </div>

                {{-- Hidden input untuk kirim tipe reset --}}
                <input type="hidden" name="reset_type" id="reset_type_input" value="default">

                <div class="flex justify-center gap-2 mt-4">
                    <button type="button" onclick="document.getElementById('resetPasswordModal').classList.add('hidden')" class="text-slate-navy px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleSiswaFields() {
            const role = document.getElementById('role_id');
            const siswaFields = document.getElementById('siswaFields');
            if (role.options[role.selectedIndex].text.toLowerCase() === 'siswa') {
                siswaFields.style.display = 'block';
            } else {
                siswaFields.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleSiswaFields();
        });

        // --- Edit mode toggle ---
        const editToggleBtn = document.getElementById('editToggleBtn');
        const saveBtn = document.getElementById('saveBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const form = document.getElementById('editForm');

        editToggleBtn.addEventListener('click', () => {
            setEditMode(true);
        });

        cancelBtn.addEventListener('click', () => {
            window.location.reload();
        });

        function setEditMode(isEdit) {
            // Semua input, select, textarea
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach((input) => {
                if (input.type !== 'submit' && input.type !== 'button') {
                    input.disabled = !isEdit;
                }
            });

            // Tombol reset password (gunakan id biar jelas)
            const resetBtn = document.getElementById('resetPasswordBtn');
            if (resetBtn) {
                resetBtn.disabled = !isEdit;

                // Atur style saat aktif / nonaktif
                if (isEdit) {
                    resetBtn.classList.remove('text-gray-400', 'cursor-not-allowed');
                    resetBtn.classList.add('text-blue-600', 'hover:underline');
                } else {
                    resetBtn.classList.add('text-gray-400', 'cursor-not-allowed');
                    resetBtn.classList.remove('text-blue-600', 'hover:underline');
                }
            }

            // Toggle tombol simpan, batal, dan edit
            saveBtn.classList.toggle('hidden', !isEdit);
            cancelBtn.classList.toggle('hidden', !isEdit);
            editToggleBtn.classList.toggle('hidden', isEdit);
        }

        document.getElementById('backBtn').addEventListener('click', function() {
            const headerTitle = document.getElementById('headerTitle');
            headerTitle.textContent = 'Detail User';

            setTimeout(() => {
                window.location.href = "{{ route('admin.user') }}";
            }, 300);
        });

        function showResetPasswordModal() {
            document.getElementById('resetPasswordModal').classList.remove('hidden');
        }

        function toggleCustomPassword() {
            const resetType = document.getElementById('resetType').value;
            const customFields = document.getElementById('customPasswordFields');
            const hiddenInput = document.getElementById('reset_type_input');

            if (resetType === 'custom') {
                customFields.classList.remove('hidden');
                hiddenInput.value = 'custom';
            } else {
                customFields.classList.add('hidden');
                hiddenInput.value = 'default';
            }
        }
    </script>
</body>
</html>
