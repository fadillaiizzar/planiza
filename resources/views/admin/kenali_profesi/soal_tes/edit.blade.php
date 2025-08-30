<div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-none">

    <!-- Header -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 20h.01M12 4a8 8 0 00-8 8v5h16v-5a8 8 0 00-8-8z"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-white">Edit Soal Tes</h2>
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
        <form action="{{ route('admin.kenali-profesi.soal-tes.update', $soalTes->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Pilih Tes -->
            <div class="space-y-1">
                <label for="tes_id" class="block text-sm font-semibold text-slate-700">Tes</label>
                <select name="tes_id" id="tes_id" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                    <option value="">-- Pilih Tes --</option>
                    @foreach($tesList as $tes)
                        <option value="{{ $tes->id }}" {{ $tes->id == old('tes_id', $soalTes->tes_id) ? 'selected' : '' }}>
                            {{ $tes->nama_tes }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Isi Pertanyaan -->
            <div class="space-y-1">
                <label for="isi_pertanyaan" class="block text-sm font-semibold text-slate-700">Isi Pertanyaan</label>
                <textarea name="isi_pertanyaan" id="isi_pertanyaan" rows="3" required
                          class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">{{ old('isi_pertanyaan', $soalTes->isi_pertanyaan) }}</textarea>
            </div>

            <!-- Jenis Soal -->
            <div class="space-y-1">
                <label for="jenis_soal" class="block text-sm font-semibold text-slate-700">Jenis Soal</label>
                <select name="jenis_soal" id="jenis_soal" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                    <option value="single" {{ old('jenis_soal', $soalTes->jenis_soal) == 'single' ? 'selected' : '' }}>Single</option>
                    <option value="multi" {{ old('jenis_soal', $soalTes->jenis_soal) == 'multi' ? 'selected' : '' }}>Multi</option>
                </select>
            </div>

            <!-- Maksimal Pilihan -->
            <div class="space-y-1">
                <label for="max_select" class="block text-sm font-semibold text-slate-700">Maksimal Pilihan (jika Multi)</label>
                <input type="number" name="max_select" id="max_select"
                       value="{{ old('max_select', $soalTes->max_select) }}"
                       placeholder="Isi jika multi"
                       class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
            </div>

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
