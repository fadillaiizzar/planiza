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
                <h2 class="text-lg font-semibold text-white">Tambah Materi</h2>
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
        <form action="{{ route('admin.materi.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <!-- Topik Materi -->
            <div class="space-y-1">
                <label for="topik_materi_id" class="flex items-center text-sm font-semibold text-slate-700">
                    Topik Materi
                </label>
                <select name="topik_materi_id" id="topik_materi_id" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
                    <option value="">Pilih Topik Materi</option>
                    @foreach($topikMateriList as $topik)
                        <option value="{{ $topik->id }}" {{ old('topik_materi_id') == $topik->id ? 'selected' : '' }}>
                            {{ $topik->judul_topik }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Materi -->
            <div class="space-y-1">
                <label for="nama_materi" class="flex items-center text-sm font-semibold text-slate-700">Nama Materi</label>
                <input type="text" name="nama_materi" id="nama_materi" value="{{ old('nama_materi') }}" placeholder="Masukkan nama materi" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white" required>
            </div>

            <!-- Deskripsi Materi -->
            <div class="space-y-1">
                <label for="deskripsi_materi" class="flex items-center text-sm font-semibold text-slate-700">Deskripsi Materi</label>
                <textarea name="deskripsi_materi" id="deskripsi_materi" rows="3" placeholder="Jelaskan detail materi" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white resize-none" required>{{ old('deskripsi_materi') }}</textarea>
            </div>

            <!-- File Materi dan Tipe File -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label for="tipe_file" class="block text-sm font-semibold text-slate-700">Tipe File</label>
                    <select name="tipe_file" id="tipe_file" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm" required>
                        <option value="">Pilih Tipe File</option>
                        <option value="pdf">PDF</option>
                        <option value="img">Gambar</option>
                        <option value="video">Video</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="file_materi" class="block text-sm font-semibold text-slate-700">File Materi</label>
                    <input type="file" name="file_materi[]" id="file_materi" multiple class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm" required>
                </div>
            </div>

            <!-- Preview -->
            <div id="preview" class="mt-3 space-y-2"></div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-center pt-4 gap-3">
                <div class="flex items-center justify-center gap-5">
                    <a href="{{ route('admin.materi.index') }}" class="text-slate-600 hover:text-slate-800 font-medium transition-all duration-200 hover:underline">
                        Batal
                    </a>
                    <button type="submit" class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200">
                        Simpan Materi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipeFile = document.getElementById('tipe_file');
    const fileMateri = document.getElementById('file_materi');
    const preview = document.getElementById('preview');

    tipeFile.addEventListener('change', function() {
        preview.innerHTML = '';
        fileMateri.value = '';

        if (tipeFile.value === 'pdf') fileMateri.accept = '.pdf';
        if (tipeFile.value === 'img') fileMateri.accept = 'image/*';
        if (tipeFile.value === 'video') fileMateri.accept = 'video/*';
    });

    fileMateri.addEventListener('change', function() {
        preview.innerHTML = '';
        Array.from(fileMateri.files).forEach(file => {
            const div = document.createElement('div');
            div.classList.add('p-2', 'border', 'rounded-lg', 'bg-slate-50');
            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.classList.add('h-20', 'object-cover', 'rounded');
                div.appendChild(img);
            } else {
                div.textContent = file.name;
            }
            preview.appendChild(div);
        });
    });
});
</script>
