<div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-none">

    <!-- Form Header -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Edit Profesi Kerja</h2>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mx-6 mt-4 px-3 py-2 bg-red-50 border-l-4 border-red-400 rounded-r-lg">
            <div class="flex items-center">
                <svg class="w-4 h-4 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
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
        <form action="{{ route('admin.profesi-kerja.update', $profesi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Nama Profesi -->
            <div class="space-y-1">
                <label for="nama_profesi_kerja" class="block text-sm font-semibold text-slate-700">Nama Profesi</label>
                <input type="text" name="nama_profesi_kerja" id="nama_profesi_kerja" value="{{ old('nama_profesi_kerja', $profesi->nama_profesi_kerja) }}" placeholder="Masukkan Nama Profesi"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
            </div>

            <!-- Gambar -->
            <div class="space-y-1">
                <label for="gambar" class="block text-sm font-semibold text-slate-700">Gambar</label>
                @if($profesi->gambar)
                    <img src="{{ asset('storage/' . $profesi->gambar) }}" alt="Gambar Profesi" class="w-32 h-32 object-cover mb-2 rounded-lg">
                @endif
                <input type="file" name="gambar" id="gambar" class="w-full text-sm text-slate-700">
            </div>

            <!-- Gaji -->
            <div class="space-y-1">
                <label for="gaji" class="block text-sm font-semibold text-slate-700">Gaji</label>
                <input type="number" name="gaji" id="gaji" value="{{ old('gaji', $profesi->gaji) }}" placeholder="Masukkan Gaji"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-1">
                <label for="deskripsi" class="block text-sm font-semibold text-slate-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Deskripsi Profesi"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>{{ old('deskripsi', $profesi->deskripsi) }}</textarea>
            </div>

            <!-- Info Skill -->
            <div class="space-y-1">
                <label for="info_skill" class="block text-sm font-semibold text-slate-700">Info Skill</label>
                <textarea name="info_skill" id="info_skill" rows="3" placeholder="Skill yang dibutuhkan"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>{{ old('info_skill', $profesi->info_skill) }}</textarea>
            </div>

            <!-- Info Jurusan -->
            <div class="space-y-1">
                <label for="info_jurusan" class="block text-sm font-semibold text-slate-700">Info Jurusan</label>
                <textarea name="info_jurusan" id="info_jurusan" rows="3" placeholder="Jurusan yang sesuai"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>{{ old('info_jurusan', $profesi->info_jurusan) }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-center pt-4 gap-5">
                <button onclick="closeModalEdit()" type="button" class="text-slate-600 hover:text-slate-800 font-medium transition-all duration-200 hover:underline">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
