<div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-none">

    <!-- Form Header -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0
                             01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Edit Data Industri</h2>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mx-6 mt-4 px-3 py-2 bg-red-50 border-l-4 border-red-400 rounded-r-lg">
            <div class="flex items-center">
                <svg class="w-4 h-4 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1
                             0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1
                             0 101.414 1.414L10 11.414l1.293 1.293a1 1
                             0 001.414-1.414L11.414 10l1.293-1.293a1 1
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
        <form action="{{ route('admin.eksplorasi-profesi.industri.update', $industri->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Nama Industri -->
            <div class="space-y-1">
                <label for="nama_industri" class="block text-sm font-semibold text-slate-700">Nama Industri</label>
                <input type="text" name="nama_industri" id="nama_industri"
                       value="{{ old('nama_industri', $industri->nama_industri) }}"
                       placeholder="Masukkan Nama Industri"
                       class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white"
                       required>
            </div>

            <!-- Website -->
            <div class="space-y-1">
                <label for="website" class="block text-sm font-semibold text-slate-700">Website</label>
                <input type="url" name="website" id="website"
                       value="{{ old('website', $industri->website) }}"
                       placeholder="https://contoh.com"
                       class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
            </div>

            <!-- Alamat -->
            <div class="space-y-1">
                <label for="alamat" class="block text-sm font-semibold text-slate-700">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3"
                          placeholder="Alamat Industri"
                          class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white"
                          required>{{ old('alamat', $industri->alamat) }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-center pt-4 gap-5">
                <button onclick="closeModalEdit()" type="button"
                        class="text-slate-600 hover:text-slate-800 font-medium transition-all duration-200 hover:underline">
                    Batal
                </button>
                <button type="submit"
                        class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900
                               text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
