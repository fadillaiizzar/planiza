<!DOCTYPE html>
<html>
<head>
    <title>Tambah Topik Materi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-poppins bg-slate-50">

    <div class="min-h-screen overflow-y-auto py-10 px-4 flex items-center justify-center">
        <div class="w-full max-w-md border border-border py-8 shadow-xl rounded-2xl bg-white">

            <!-- Header -->
            <div class="flex items-center mb-0 px-6">
                <a href="{{ route('admin.materi.index') }}" class="p-2 text-slate-600 hover:text-slate-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-slate-800 ml-2">Tambah Topik Materi</h2>
            </div>

            <!-- Error -->
            @if ($errors->any())
                <div class="mt-4 mx-6 px-4 py-3 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="text-sm text-red-600 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <div class="px-8 pt-3">
                <form action="{{ route('admin.materi.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Judul Topik -->
                    <div>
                        <label for="judul_topik" class="block text-sm font-medium text-slate-700 mb-2">Judul Topik</label>
                        <input type="text" name="judul_topik" id="judul_topik" value="{{ old('judul_topik') }}" placeholder="Masukkan Judul Topik"
                            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 text-slate-900 @error('judul_topik') border-red-500 @enderror" required>
                        @error('judul_topik')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label for="kelas_id" class="block text-sm font-medium text-slate-700 mb-2">Kelas</label>
                        <select name="kelas_id" id="kelas_id"
                            class="w-full px-4 py-3 border border-border rounded-lg text-slate-900 @error('kelas_id') border-red-500 @enderror" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jurusan -->
                    <div>
                        <label for="jurusan_id" class="block text-sm font-medium text-slate-700 mb-2">Jurusan</label>
                        <select name="jurusan_id" id="jurusan_id"
                            class="w-full px-4 py-3 border border-border rounded-lg text-slate-900 @error('jurusan_id') border-red-500 @enderror" required>
                            <option value="">Pilih Jurusan</option>
                            @foreach($jurusanList as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rencana -->
                    <div>
                        <label for="rencana_id" class="block text-sm font-medium text-slate-700 mb-2">Rencana</label>
                        <select name="rencana_id" id="rencana_id"
                            class="w-full px-4 py-3 border border-border rounded-lg text-slate-900 @error('rencana_id') border-red-500 @enderror" required>
                            <option value="">Pilih Rencana</option>
                            @foreach($rencanaList as $rencana)
                                <option value="{{ $rencana->id }}" {{ old('rencana_id') == $rencana->id ? 'selected' : '' }}>
                                    {{ $rencana->nama_rencana }}
                                </option>
                            @endforeach
                        </select>
                        @error('rencana_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Button -->
                    <div class="flex justify-center">
                        <button type="submit"
                            class="bg-slate-700 hover:bg-slate-800 text-white font-semibold w-full py-3 px-6 rounded-lg transition-colors focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
