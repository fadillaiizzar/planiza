<div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-none">

    <!-- Form Header -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Tambah Profesi Kerja</h2>
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
        <form action="{{ route('admin.profesi-kerja.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf

            <!-- Nama Profesi -->
            <div class="space-y-1">
                <label for="nama_profesi_kerja" class="block text-sm font-semibold text-slate-700">Nama Profesi</label>
                <input type="text" name="nama_profesi_kerja" id="nama_profesi_kerja"
                    value="{{ old('nama_profesi_kerja') }}" placeholder="Masukkan Nama Profesi"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
            </div>

            <!-- Gambar -->
            <div class="space-y-1">
                <label for="gambar" class="block text-sm font-semibold text-slate-700">Gambar</label>
                <input type="file" name="gambar" id="gambar"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                <p class="text-xs text-slate-500 mt-1">Format: JPG, JPEG, PNG | Maks: 2MB</p>
            </div>

            <!-- Gaji -->
            <div class="space-y-1">
                <label for="gaji" class="block text-sm font-semibold text-slate-700">Gaji</label>
                <input type="number" name="gaji" id="gaji" value="{{ old('gaji') }}"
                    placeholder="Masukkan Gaji"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-1">
                <label for="deskripsi" class="block text-sm font-semibold text-slate-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white"
                    placeholder="Masukkan deskripsi profesi..." required>{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Skill -->
            <div class="space-y-1">
                <label for="info_skill" class="block text-sm font-semibold text-slate-700">Skill</label>
                <textarea name="info_skill" id="info_skill" rows="2"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white"
                    placeholder="Skill yang dibutuhkan..." required>{{ old('info_skill') }}</textarea>
            </div>

            <!-- Jurusan -->
            <div class="space-y-1">
                <label for="info_jurusan" class="block text-sm font-semibold text-slate-700">Jurusan</label>
                <textarea name="info_jurusan" id="info_jurusan" rows="2"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white"
                    placeholder="Jurusan yang relevan..." required>{{ old('info_jurusan') }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-center pt-4 gap-5">
                <button onclick="closeModal()" type="button"
                    class="text-slate-600 hover:text-slate-800 font-medium transition-all duration-200 hover:underline">
                    Batal
                </button>
                <button type="submit"
                    class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
