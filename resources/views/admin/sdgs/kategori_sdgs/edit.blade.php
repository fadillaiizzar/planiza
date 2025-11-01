<div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-none">

    <!-- Header -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 17h2m-1-12a9 9 0 100 18 9 9 0 000-18z"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-white">Edit Kategori SDGs</h2>
        </div>
    </div>

    @if ($errors->any())
        <div class="mx-6 mt-4 px-3 py-2 bg-red-50 border-l-4 border-red-400 rounded-r-lg">
            <h4 class="text-red-800 font-medium text-sm">Terdapat kesalahan:</h4>
            <ul class="text-sm text-red-700 list-disc pl-6 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="px-6 pt-2 pb-6">
        <form action="{{ route('admin.sdgs.kategori-sdgs.update', $kategoriSdgs->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Nomor -->
            <div class="space-y-1">
                <label for="nomor_kategori" class="block text-sm font-semibold text-slate-700">Nomor Kategori</label>
                <input type="number" name="nomor_kategori" id="nomor_kategori" min="1" max="17"
                       value="{{ old('nomor_kategori', $kategoriSdgs->nomor_kategori) }}"
                       class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
            </div>

            <!-- Nama -->
            <div class="space-y-1">
                <label for="nama_kategori" class="block text-sm font-semibold text-slate-700">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori"
                       value="{{ old('nama_kategori', $kategoriSdgs->nama_kategori) }}"
                       class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-1">
                <label for="deskripsi" class="block text-sm font-semibold text-slate-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                          class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>{{ old('deskripsi', $kategoriSdgs->deskripsi) }}</textarea>
            </div>

            <!-- Tombol -->
            <div class="flex items-center justify-center pt-4 gap-5">
                <button onclick="closeModalEdit()" type="button"
                    class="text-slate-600 hover:text-slate-800 font-medium transition-all duration-200 hover:underline">
                    Batal
                </button>
                <button type="submit"
                    class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
