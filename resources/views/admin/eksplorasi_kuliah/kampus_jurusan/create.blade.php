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
                <h2 class="text-lg font-semibold text-white">Tambah Relasi Kampus - Jurusan</h2>
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
        <form id="formKampusJurusan" action="{{ route('admin.eksplorasi-jurusan.kampus-jurusan.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Pilih Kampus -->
            <div class="space-y-1">
                <label for="kampus_id" class="block text-sm font-semibold text-slate-700">Kampus</label>
                <select name="kampus_id" id="kampus_id"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
                    <option value="">-- Pilih Kampus --</option>
                    @foreach ($kampus as $k)
                        <option value="{{ $k->id }}" {{ old('kampus_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kampus }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Jurusan Kuliah -->
            <div class="space-y-1">
                <label for="jurusan_kuliah_id" class="block text-sm font-semibold text-slate-700">Jurusan Kuliah</label>
                <select name="jurusan_kuliah_id" id="jurusan_kuliah_id"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
                    <option value="">-- Pilih Jurusan Kuliah --</option>
                    @foreach ($jurusanKuliahs as $j)
                        <option value="{{ $j->id }}" {{ old('jurusan_kuliah_id') == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jurusan_kuliah }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Input Passing Grade -->
            <div class="space-y-1">
                <label for="passing_grade" class="block text-sm font-semibold text-slate-700">Passing Grade</label>
                <input type="number" name="passing_grade" id="passing_grade" min="0" max="1000"
                    value="{{ old('passing_grade') }}"
                    class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white"
                    placeholder="Masukkan nilai passing grade" required>
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

@include('admin.eksplorasi_kuliah.kampus_jurusan.popup-confirm-replace')

<script>
    document.getElementById('formKampusJurusan').addEventListener('submit', async function (e) {
        e.preventDefault();

        const kampusId = document.getElementById('kampus_id').value;
        const jurusanId = document.getElementById('jurusan_kuliah_id').value;

        const sudahAda = true;

        if (sudahAda) {
            showConfirmModal(() => {
                e.target.submit();
            });
        } else {
            e.target.submit();
        }
    });
</script>
