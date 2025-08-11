<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Planiza')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
    <body class="font-poppins bg-off-white text-slate-navy">
        <div class="flex min-h-screen">
            <main class="p-6 bg-slate-50 min-h-screen">
                <h1 class="text-2xl font-bold mb-6">Tambah Topik Materi</h1>

                <form action="{{ route('admin.materi.store') }}" method="POST" class="max-w-lg bg-white p-6 rounded shadow">
                    @csrf

                    <div class="mb-4">
                        <label for="judul_topik" class="block font-semibold mb-1">Judul Topik</label>
                        <input type="text" name="judul_topik" id="judul_topik" value="{{ old('judul_topik') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 @error('judul_topik') border-red-500 @enderror" required>
                        @error('judul_topik')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="kelas_id" class="block font-semibold mb-1">Kelas</label>
                        <select name="kelas_id" id="kelas_id"
                            class="w-full border border-gray-300 rounded px-3 py-2 @error('kelas_id') border-red-500 @enderror" required>
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

                    <div class="mb-4">
                        <label for="jurusan_id" class="block font-semibold mb-1">Jurusan</label>
                        <select name="jurusan_id" id="jurusan_id"
                            class="w-full border border-gray-300 rounded px-3 py-2 @error('jurusan_id') border-red-500 @enderror" required>
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

                    <div class="mb-4">
                        <label for="rencana_id" class="block font-semibold mb-1">Rencana</label>
                        <select name="rencana_id" id="rencana_id"
                            class="w-full border border-gray-300 rounded px-3 py-2 @error('rencana_id') border-red-500 @enderror" required>
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

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
                    <a href="{{ route('admin.materi.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
                </form>
            </main>
        </div>
    </body>
</html>


