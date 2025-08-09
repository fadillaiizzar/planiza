@extends('layouts.admin')

@section('title', 'Edit Topik Materi - Planiza')

@section('content')
<main class="p-6 bg-slate-50 min-h-screen">
    <h1 class="text-2xl font-bold mb-6">Edit Topik Materi</h1>

    <form action="{{ route('topik-materi.update', $topik->id) }}" method="POST" class="max-w-lg bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="judul_topik" class="block font-semibold mb-1">Judul Topik</label>
            <input type="text" name="judul_topik" id="judul_topik" value="{{ old('judul_topik', $topik->judul_topik) }}"
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
                    <option value="{{ $kelas->id }}" {{ old('kelas_id', $topik->kelas_id) == $kelas->id ? 'selected' : '' }}>
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
                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $topik->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
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
                    <option value="{{ $rencana->id }}" {{ old('rencana_id', $topik->rencana_id) == $rencana->id ? 'selected' : '' }}>
                        {{ $rencana->nama_rencana }}
                    </option>
                @endforeach
            </select>
            @error('rencana_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Update</button>
        <a href="{{ route('topik-materi.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
    </form>
</main>
@endsection
