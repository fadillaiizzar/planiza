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
                <h2 class="text-lg font-semibold text-white">Tambah Hubungan SDGs</h2>
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
        <form action="{{ route('admin.sdgs.hubungan-sdgs.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Pilih Kategori SDGs -->
            <div class="space-y-1">
                <label for="kategori_sdgs_id" class="block text-sm font-semibold text-slate-700">
                    Kategori SDGs
                </label>
                <select name="kategori_sdgs_id" id="kategori_sdgs_id"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
                    <option value="">-- Pilih Kategori SDGs --</option>
                    @foreach ($kategoriSdgs as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_sdgs_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nomor_kategori }} - {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Profesi (Multiple Custom) -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-slate-700 flex justify-between items-center">
                    <span>Profesi Kerja</span>
                    <span id="profesiCount" class="text-xs text-slate-500">0 dipilih</span>
                </label>
                <div id="profesiContainer" class="border border-slate-300 rounded-xl max-h-48 overflow-y-auto bg-white">
                    @foreach ($profesis as $profesi)
                    <div class="px-3 py-2 hover:bg-slate-100 cursor-pointer flex items-center profesi-item">
                        <input type="checkbox" name="profesi_kerja_id[]" value="{{ $profesi->id }}" class="mr-2 profesi-checkbox"
                            @if(old('profesi_kerja_id') && in_array($profesi->id, old('profesi_kerja_id'))) checked @endif>
                        <span class="flex-1 cursor-pointer">{{ $profesi->nama_profesi_kerja }}</span>
                    </div>
                    @endforeach
                </div>
                <p class="text-xs text-slate-500 mt-1">* Bisa pilih lebih dari satu</p>
            </div>

            <!-- Pilih Jurusan (Multiple Custom) -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-slate-700 flex justify-between items-center">
                    <span>Jurusan Kuliah</span>
                    <span id="jurusanCount" class="text-xs text-slate-500">0 dipilih</span>
                </label>
                <div id="jurusanContainer" class="border border-slate-300 rounded-xl max-h-48 overflow-y-auto bg-white">
                    @foreach ($jurusans as $jurusan)
                    <div class="px-3 py-2 hover:bg-slate-100 cursor-pointer flex items-center jurusan-item">
                        <input type="checkbox" name="jurusan_kuliah_id[]" value="{{ $jurusan->id }}" class="mr-2 jurusan-checkbox"
                            @if(old('jurusan_kuliah_id') && in_array($jurusan->id, old('jurusan_kuliah_id'))) checked @endif>
                        <span class="flex-1 cursor-pointer">{{ $jurusan->nama_jurusan_kuliah }}</span>
                    </div>
                    @endforeach
                </div>
                <p class="text-xs text-slate-500 mt-1">* Bisa pilih lebih dari satu</p>
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

<script>
function updateCount(containerId, checkboxClass, countId) {
    const container = document.getElementById(containerId);
    const countEl = document.getElementById(countId);
    const checkboxes = container.querySelectorAll(`.${checkboxClass}`);

    let count = 0;
    checkboxes.forEach(cb => { if(cb.checked) count++; });
    countEl.textContent = `${count} dipilih`;
}

// Toggle checkbox saat klik div atau span
document.querySelectorAll('.profesi-item, .jurusan-item').forEach(item => {
    item.addEventListener('click', function(e) {
        // Jangan toggle kalau klik langsung checkbox
        if(e.target.tagName !== 'INPUT') {
            const checkbox = this.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
        }
        // Update count sesuai container
        updateCount('profesiContainer', 'profesi-checkbox', 'profesiCount');
        updateCount('jurusanContainer', 'jurusan-checkbox', 'jurusanCount');
    });
});

// Inisialisasi count saat load
updateCount('profesiContainer', 'profesi-checkbox', 'profesiCount');
updateCount('jurusanContainer', 'jurusan-checkbox', 'jurusanCount');
</script>
