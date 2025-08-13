<div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">

    <!-- Form Header -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Tambah Materi Baru</h2>
                <p class="text-slate-300 text-xs">Lengkapi informasi materi pembelajaran</p>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <!-- Reduced error section padding and font sizes -->
        <div class="mx-6 mt-4 px-3 py-2 bg-red-50 border-l-4 border-red-400 rounded-r-lg">
            <div class="flex items-center">
                <svg class="w-4 h-4 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <h4 class="text-red-800 font-medium text-sm">Terdapat kesalahan:</h4>
            </div>
            <ul class="text-xs text-red-700 list-disc pl-6 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Content -->
    <!-- Reduced form padding and spacing -->
    <div class="px-6 py-6">
        <form action="{{ route('admin.materi.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Topik Materi -->
            <div class="space-y-1">
                <!-- Smaller label font and icon -->
                <label for="topik_materi_id" class="flex items-center text-xs font-semibold text-slate-700">
                    <svg class="w-3 h-3 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Topik Materi
                </label>
                <!-- Reduced input padding and font size -->
                <select name="topik_materi_id" id="topik_materi_id"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white
                    focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200
                    hover:border-slate-400 @error('topik_materi_id') border-red-400 bg-red-50 @enderror" required>
                    <option value="">Pilih Topik Materi</option>
                    @foreach($topikMateriList as $topik)
                        <option value="{{ $topik->id }}" {{ old('topik_materi_id') == $topik->id ? 'selected' : '' }}>
                            {{ $topik->judul_topik }}
                        </option>
                    @endforeach
                </select>
                @error('topik_materi_id')
                    <!-- Smaller error text and icon -->
                    <p class="text-red-600 text-xs flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Nama Materi -->
            <div class="space-y-1">
                <label for="nama_materi" class="flex items-center text-xs font-semibold text-slate-700">
                    <svg class="w-3 h-3 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Nama Materi
                </label>
                <input type="text" name="nama_materi" id="nama_materi"
                    value="{{ old('nama_materi') }}"
                    placeholder="Masukkan nama materi pembelajaran"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white
                    focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200
                    hover:border-slate-400 @error('nama_materi') border-red-400 bg-red-50 @enderror" required>
                @error('nama_materi')
                    <p class="text-red-600 text-xs flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Deskripsi Materi -->
            <div class="space-y-1">
                <label for="deskripsi_materi" class="flex items-center text-xs font-semibold text-slate-700">
                    <svg class="w-3 h-3 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    Deskripsi Materi
                </label>
                <!-- Reduced textarea rows and padding -->
                <textarea name="deskripsi_materi" id="deskripsi_materi" rows="3"
                    placeholder="Jelaskan detail materi pembelajaran yang akan ditambahkan"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white
                    focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200
                    hover:border-slate-400 resize-none @error('deskripsi_materi') border-red-400 bg-red-50 @enderror" required>{{ old('deskripsi_materi') }}</textarea>
                @error('deskripsi_materi')
                    <p class="text-red-600 text-xs flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- File Information Grid -->
            <!-- Reduced grid gap -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Tipe File -->
                <div class="space-y-1">
                    <label for="tipe_file" class="flex items-center text-xs font-semibold text-slate-700">
                        <svg class="w-3 h-3 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        Tipe File
                    </label>
                    <input type="text" name="tipe_file" id="tipe_file"
                        value="{{ old('tipe_file') }}"
                        placeholder="pdf, docx, mp4, pptx"
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white
                        focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200
                        hover:border-slate-400 @error('tipe_file') border-red-400 bg-red-50 @enderror" required>
                    @error('tipe_file')
                        <p class="text-red-600 text-xs flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- File Materi -->
                <div class="space-y-1">
                    <label for="file_materi" class="flex items-center text-xs font-semibold text-slate-700">
                        <svg class="w-3 h-3 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        File Materi
                    </label>
                    <input type="text" name="file_materi" id="file_materi"
                        value="{{ old('file_materi') }}"
                        placeholder="Path atau nama file materi"
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white
                        focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200
                        hover:border-slate-400 @error('file_materi') border-red-400 bg-red-50 @enderror" required>
                    @error('file_materi')
                        <p class="text-red-600 text-xs flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-4 border-t border-slate-200">
                <a href="{{ route('admin.materi.index') }}"
                    class="text-slate-600 hover:text-slate-800 text-sm font-medium transition-all duration-200 hover:underline">
                    Batal
                </a>

                <button type="submit"
                    class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900
                    text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200
                    focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 shadow-lg hover:shadow-xl
                    flex items-center space-x-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Simpan Materi</span>
                </button>
            </div>
        </form>
    </div>
</div>
