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
                <h2 class="text-lg font-semibold text-white">Edit Materi</h2>
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
    <div class="px-6 pt-2 pb-6 ">
        <form action="{{ route('admin.pembelajaran.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Nama Materi -->
            <div class="space-y-1">
                <label for="nama_materi" class="block text-sm font-semibold text-slate-700">Nama Materi</label>
                <input type="text" name="nama_materi" id="nama_materi" value="{{ old('nama_materi', $materi->nama_materi) }}"
                    placeholder="Masukkan Nama Materi"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white @error('nama_materi') border-red-500 @enderror" required>
                @error('nama_materi')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi Materi -->
            <div class="space-y-1">
                <label for="deskripsi_materi" class="block text-sm font-semibold text-slate-700">Deskripsi Materi</label>
                <textarea name="deskripsi_materi" id="deskripsi_materi" rows="4"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white @error('deskripsi_materi') border-red-500 @enderror"
                    placeholder="Tuliskan deskripsi materi...">{{ old('deskripsi_materi', $materi->deskripsi_materi) }}</textarea>
                @error('deskripsi_materi')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipe File -->
            <div class="space-y-1">
                <label for="tipe_file" class="block text-sm font-semibold text-slate-700">Tipe File</label>
                <select name="tipe_file" id="tipe_file"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white @error('tipe_file') border-red-500 @enderror" required>
                    <option value="">Pilih Tipe</option>
                    <option value="pdf" {{ old('tipe_file', $materi->tipe_file) == 'pdf' ? 'selected' : '' }}>PDF</option>
                    <option value="img" {{ old('tipe_file', $materi->tipe_file) == 'img' ? 'selected' : '' }}>Gambar</option>
                    <option value="video" {{ old('tipe_file', $materi->tipe_file) == 'video' ? 'selected' : '' }}>Video</option>
                </select>
                @error('tipe_file')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Materi -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-slate-700">File Materi</label>

                <!-- Preview File Saat Ini -->
                @if($materi->file_materi)
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 mb-3">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-sm text-slate-600">File saat ini: {{ $materi->file_materi }}</span>
                        </div>
                    </div>
                @endif

                <!-- Upload File Baru -->
                <input type="file" name="file_materi[]" id="file_materi" multiple
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white @error('file_materi') border-red-500 @enderror">
                @error('file_materi')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengubah file</p>
            </div>


            <!-- Action Buttons -->
            <div class="flex items-center justify-center pt-4 gap-5">
                <button onclick="closeModalEditMateri()" class="text-slate-600 hover:text-slate-800 font-medium transition-all duration-200 hover:underline">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>

</div>
