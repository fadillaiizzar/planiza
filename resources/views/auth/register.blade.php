<!-- Popup Container -->
<div class="w-full max-w-2xl mx-auto bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-none">

    <!-- Form Header -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
        <div class="flex items-center space-x-3">
            <button onclick="closeModal()" class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </button>
            <h2 class="text-lg font-semibold text-white">Tambah User</h2>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mx-6 mt-4 px-3 py-2 bg-red-50 border-l-4 border-red-400 rounded-r-lg">
            <div class="flex items-center">
                <svg class="w-4 h-4 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414
                            1.414L8.586 10l-1.293 1.293a1 1 0 101.414
                            1.414L10 11.414l1.293 1.293a1 1 0
                            001.414-1.414L11.414 10l1.293-1.293a1 1
                            0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"/>
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
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nama -->
            <div class="space-y-1">
                <label for="name" class="block text-sm font-semibold text-slate-700">Nama</label>
                <input type="text" name="name" id="name" placeholder="Nama" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900">
            </div>

            <!-- Username -->
            <div class="space-y-1">
                <label for="username" class="block text-sm font-semibold text-slate-700">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900">
            </div>

            <!-- Password -->
            <div class="space-y-1">
                <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900">
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1">
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900">
            </div>

            <!-- Role -->
            <div class="space-y-1">
                <label for="role_id" class="block text-sm font-semibold text-slate-700">Role</label>
                <select name="role_id" id="roleSelect" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900">
                    <option value="">Pilih Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tambahan Jika Role = Siswa -->
            <div id="siswaFields" class="{{ old('role_id') && $roles->find(old('role_id'))->nama_role === 'Siswa' ? '' : 'hidden' }} space-y-4">
                <div class="space-y-1">
                    <label for="kelas_id" class="block text-sm font-semibold text-slate-700">Kelas</label>
                    <select name="kelas_id" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="jurusan_id" class="block text-sm font-semibold text-slate-700">Jurusan</label>
                    <select name="jurusan_id" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900">
                        <option value="">Pilih Jurusan</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="rencana_id" class="block text-sm font-semibold text-slate-700">Rencana (opsional)</label>
                    <select name="rencana_id" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900">
                        <option value="">-- Kosongkan jika belum ada --</option>
                        @foreach($rencanas as $rencana)
                            <option value="{{ $rencana->id }}">{{ $rencana->nama_rencana }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="no_hp" class="block text-sm font-semibold text-slate-700">No HP (opsional)</label>
                    <input type="text" name="no_hp" placeholder="-- Kosongkan jika belum ada --"
                            class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-center pt-4 gap-5">
                <button type="button" onclick="closeModal()" class="text-slate-600 hover:text-slate-800 font-medium hover:underline">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white font-semibold px-6 py-2 rounded-xl">
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('roleSelect');
        const siswaFields = document.getElementById('siswaFields');

        roleSelect.addEventListener('change', function () {
            const selectedText = this.options[this.selectedIndex].text;
            siswaFields.classList.toggle('hidden', selectedText !== 'Siswa');
        });
    });

    function closeModal() {
        document.querySelector('.fixed.inset-0').classList.add('hidden');
    }
</script>
