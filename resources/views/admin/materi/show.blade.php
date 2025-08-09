@extends('layouts.admin')

@section('title', 'Detail Topik Materi - Planiza')

@section('content')
<main class="p-6 bg-slate-50 min-h-screen">
    <h1 class="text-2xl font-bold mb-6">Detail Topik Materi</h1>

    <div class="max-w-lg bg-white p-6 rounded shadow">
        <p><strong>ID:</strong> {{ $topik->id }}</p>
        <p><strong>Judul Topik:</strong> {{ $topik->judul_topik }}</p>
        <p><strong>Kelas:</strong> {{ $topik->kelas->nama_kelas ?? '-' }}</p>
        <p><strong>Jurusan:</strong> {{ $topik->jurusan->nama_jurusan ?? '-' }}</p>
        <p><strong>Rencana:</strong> {{ $topik->rencana->nama_rencana ?? '-' }}</p>
    </div>

    <a href="{{ route('topik-materi.index') }}" class="inline-block mt-6 text-blue-600 hover:underline">Kembali ke Daftar Topik Materi</a>
</main>
@endsection
