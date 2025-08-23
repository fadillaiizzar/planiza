<div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-none">

    <!-- Form Header -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Edit User</h2>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mx-6 mt-4 px-3 py-2 bg-red-50 border-l-4 border-red-400 rounded-r-lg">
            <div class="flex items-center">
                <svg class="w-4 h-4 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <h4 class="text-red-800 font-medium text-sm">Terdapat kesalahan:</h4>
            </div>
            <ul class="text-sm text-red-700 list-disc pl-6 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Content -->
    <div class="px-6 pt-2 pb-6">
        <form action="{{ route('admin.user.update', $detailUser->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Nama -->
            <div class="space-y-1">
                <label for="name" class="block text-sm font-semibold text-slate-700">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $detailUser->name) }}"
                    placeholder="Masukkan Nama"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
            </div>

            <!-- Username -->
            <div class="space-y-1">
                <label for="username" class="block text-sm font-semibold text-slate-700">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username', $detailUser->username) }}"
                    placeholder="Masukkan Username"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
            </div>

            <!-- Password (dummy) -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-slate-700">Password</label>
                <input type="password" value="********" disabled
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-slate-100 cursor-not-allowed">
                <button type="button" id="toggleResetBtn"
                    class="text-xs text-blue-600 hover:underline mt-1">
                    Reset password
                </button>
            </div>

            <!-- Reset Password Section (hidden default) -->
            <div id="resetPasswordBox" class="hidden">
                @include('admin.user.reset-password')
            </div>

            <div class="h-3"></div>

            <!-- Role -->
            <div class="space-y-1">
                <label for="role_id" class="block text-sm font-semibold text-slate-700">Role</label>
                <select name="role_id" id="roleSelect"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
                    <option value="">Pilih Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $detailUser->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->nama_role }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fields untuk Siswa -->
            <div id="siswaFields" class="{{ (isset($detailUser) && $detailUser->role->nama_role === 'Siswa') ? '' : 'hidden' }} space-y-4 mt-4">
                <div class="space-y-1">
                    <label for="kelas_id" class="block text-sm font-semibold text-slate-700">Kelas</label>
                    <select name="kelas_id" id="kelas_id"
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $item)
                            <option value="{{ $item->id }}" {{ old('kelas_id', $siswa->kelas_id ?? '') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="jurusan_id" class="block text-sm font-semibold text-slate-700">Jurusan</label>
                    <select name="jurusan_id" id="jurusan_id"
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                        <option value="">Pilih Jurusan</option>
                        @foreach($jurusans as $item)
                            <option value="{{ $item->id }}" {{ old('jurusan_id', $siswa->jurusan_id ?? '') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="rencana_id" class="block text-sm font-semibold text-slate-700">Rencana</label>
                    <select name="rencana_id" id="rencana_id"
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                        <option value="">Pilih Rencana</option>
                        @foreach($rencanas as $item)
                            <option value="{{ $item->id }}" {{ old('rencana_id', $siswa->rencana_id ?? '') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_rencana }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="no_hp" class="block text-sm font-semibold text-slate-700">No HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $siswa->no_hp ?? '') }}"
                        placeholder="Masukkan No HP"
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                </div>
            </div>

            <!-- Reset Password Section -->
            {{-- @include('admin.user.reset-password') --}}

            <!-- Action Buttons -->
            <div class="flex items-center justify-center pt-4 gap-5">
                <button type="button" onclick="closeModalEditUser()"
                    class="text-slate-600 hover:text-slate-800 font-medium transition-all duration-200 hover:underline">Batal</button>
                <button type="submit"
                    class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200">Update</button>
            </div>
        </form>
    </div>
</div>
