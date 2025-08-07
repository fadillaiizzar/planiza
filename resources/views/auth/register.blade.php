<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body class="font-poppins bg-slate-50">

        <!-- Wrapper agar tidak mepet dan bisa discroll -->
        <div class="min-h-screen overflow-y-auto py-10 px-4 flex items-center justify-center">
            <div class="w-full max-w-md border border-border py-8 shadow-xl rounded-2xl bg-white">

                <!-- Header -->
                <div class="flex items-center mb-0 px-6">
                    <a href="{{ url('/') }}" class="p-2 text-slate-600 hover:text-slate-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h2 class="text-2xl font-bold text-slate-800 ml-2">Daftar Akun</h2>
                </div>

                <!-- Error -->
                @if ($errors->any())
                    <div class="mt-4 mx-6 px-4 py-3 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="text-sm text-red-600 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <div class="px-8 pt-3">
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama</label>
                            <input type="text" name="name" id="name" placeholder="Nama" required
                                class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 placeholder-slate-400 text-slate-900">
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username" required
                                class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 placeholder-slate-400 text-slate-900">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" required
                                class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 placeholder-slate-400 text-slate-900">
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required
                                class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 placeholder-slate-400 text-slate-900">
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role_id" class="block text-sm font-medium text-slate-700 mb-2">Role</label>
                            <select name="role_id" id="roleSelect" required
                                class="w-full px-4 py-3 border border-border rounded-lg text-slate-900">
                                <option value="">Pilih Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tambahan Jika Role = Siswa -->
                        <div id="siswaFields" class="{{ old('role_id') && $roles->find(old('role_id'))->nama_role === 'Siswa' ? '' : 'hidden' }} space-y-4">
                            <div>
                                <label for="kelas_id" class="block text-sm font-medium text-slate-700 mb-2">Kelas</label>
                                <select name="kelas_id" class="w-full px-4 py-3 border border-border rounded-lg text-slate-900">
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="jurusan_id" class="block text-sm font-medium text-slate-700 mb-2">Jurusan</label>
                                <select name="jurusan_id" class="w-full px-4 py-3 border border-border rounded-lg text-slate-900">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach($jurusans as $jurusan)
                                        <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="rencana_id" class="block text-sm font-medium text-slate-700 mb-2">Rencana (opsional)</label>
                                <select name="rencana_id" class="w-full px-4 py-3 border border-border rounded-lg text-slate-900">
                                    <option value="">-- Kosongkan jika belum ada --</option>
                                    @foreach($rencanas as $rencana)
                                        <option value="{{ $rencana->id }}">{{ $rencana->nama_rencana }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="no_hp" class="block text-sm font-medium text-slate-700 mb-2">No HP (opsional)</label>
                                <input type="text" name="no_hp" placeholder="-- Kosongkan jika belum ada --" class="w-full px-4 py-3 border border-border rounded-lg text-slate-900">
                            </div>
                        </div>

                        <!-- Submit -->
                        <div>
                            <button type="submit"
                                class="w-full bg-slate-700 hover:bg-slate-800 text-white font-semibold py-3 rounded-lg transition-colors focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Script Show/Hide Fields -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const roleSelect = document.getElementById('roleSelect');
                const siswaFields = document.getElementById('siswaFields');

                roleSelect.addEventListener('change', function () {
                    const selectedText = this.options[this.selectedIndex].text;
                    siswaFields.classList.toggle('hidden', selectedText !== 'Siswa');
                });
            });
        </script>
    </body>
</html>
