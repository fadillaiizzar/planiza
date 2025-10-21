<div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-none">

    <!-- Header -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-edit text-white text-sm"></i>
            </div>
            <h2 class="text-lg font-semibold text-white">Edit Opsi Jawaban</h2>
        </div>
    </div>

    <!-- Error -->
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

    <!-- Form -->
    <div class="px-6 pt-2 pb-6">
        <form action="{{ route('admin.kenali-profesi.opsi-jawaban.update', $opsiJawaban->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Pilih Soal Tes -->
            <div class="space-y-1">
                <label for="soal_tes_id" class="block text-sm font-semibold text-slate-700">Soal Tes</label>
                <select name="soal_tes_id" id="soal_tes_id" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                    <option value="">-- Pilih Soal Tes --</option>
                    @foreach($soalTesList as $soal)
                        <option value="{{ $soal->id }}" {{ $soal->id == old('soal_tes_id', $opsiJawaban->soal_tes_id) ? 'selected' : '' }}>
                            {{ $soal->isi_pertanyaan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Isi Opsi -->
            <div class="space-y-1">
                <label for="isi_opsi" class="block text-sm font-semibold text-slate-700">Isi Opsi</label>
                <input type="text" name="isi_opsi" id="isi_opsi"
                       value="{{ old('isi_opsi', $opsiJawaban->isi_opsi) }}"
                       required
                       class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
            </div>

            <!-- Kategori Minat (jika single) -->
            @if($opsiJawaban->soalTes->jenis_soal === 'single')
                <div class="space-y-1">
                    <label for="kategori_minat_id" class="block text-sm font-semibold text-slate-700">Kategori Minat</label>
                    <select name="kategori_minat_id" id="kategori_minat_id"
                            class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                        <option value="">-- Pilih Kategori Minat --</option>
                        @foreach($kategoriMinatList as $kategori)
                            <option value="{{ $kategori->id }}" {{ $kategori->id == old('kategori_minat_id', $opsiJawaban->kategori_minat_id) ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Profesi Kerja (jika multi) -->
            @if($opsiJawaban->soalTes->jenis_soal === 'multi')
                <div class="space-y-1">
                    <label for="profesi_kerja_id" class="block text-sm font-semibold text-slate-700">Profesi Kerja</label>
                    <select name="profesi_kerja_id" id="profesi_kerja_id"
                            class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                        <option value="">-- Pilih Profesi Kerja --</option>
                        @foreach($profesiKerjaList as $profesi)
                            <option value="{{ $profesi->id }}" {{ $profesi->id == old('profesi_kerja_id', $opsiJawaban->profesi_kerja_id) ? 'selected' : '' }}>
                                {{ $profesi->nama_profesi_kerja }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Actions -->
            <div class="flex items-center justify-center pt-4 gap-5">
                <button type="button" onclick="closeModalEdit()"
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
