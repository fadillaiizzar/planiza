<div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-none">

    <!-- Form Header -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-white">Edit Relasi Kampus - Jurusan</h2>
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
        <form action="{{ route('admin.eksplorasi-jurusan.kampus-jurusan.update', $kampusJurusan->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Pilih Kampus -->
            <div class="space-y-1">
                <label for="kampus_id" class="block text-sm font-semibold text-slate-700">Pilih Kampus</label>
                <select name="kampus_id" id="kampus_id"
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                    @foreach($kampus as $item)
                        <option value="{{ $item->id }}"
                            {{ $kampusJurusan->kampus_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kampus }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Jurusan Kuliah -->
            <div class="space-y-1">
                <label for="jurusan_kuliah_id" class="block text-sm font-semibold text-slate-700">Pilih Jurusan Kuliah</label>
                <select name="jurusan_kuliah_id" id="jurusan_kuliah_id"
                        class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white">
                    @foreach($jurusanKuliahs as $jurusan)
                        <option value="{{ $jurusan->id }}"
                            {{ $kampusJurusan->jurusan_kuliah_id == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->nama_jurusan_kuliah }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Passing Grade -->
            <div class="space-y-1">
                <label for="passing_grade" class="block text-sm font-semibold text-slate-700">Passing Grade</label>
                <input type="number" name="passing_grade" id="passing_grade"
                       value="{{ old('passing_grade', $kampusJurusan->passing_grade) }}"
                       class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white focus:ring-2 focus:ring-slate-400">
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
