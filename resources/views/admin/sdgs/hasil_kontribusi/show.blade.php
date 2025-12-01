@extends('layouts.admin')

@section('title', 'Detail Rekomendasi SDGs')

@section('content')
    <main class="p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.sdgs.index'), 'icon' => 'fas fa-leaf', 'title' => 'SDGs'],
            ['href' => route('admin.sdgs.hasil-kontribusi.index'), 'icon' => 'fas fas fa-seedling', 'title' => 'Hasil Kontribusi'],
            ['href' => '#', 'icon' => 'fas fa-check-circle', 'title' => 'Detail Hasil'],
        ]" />

        <h2 class="text-xl font-bold mb-3">
            Detail Rekomendasi SDGs – {{ $user->name }}
        </h2>

        {{-- PROFESI --}}
        <div class="bg-white shadow rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Top 3 Profesi</h3>

            @foreach ($profesi as $item)
                <div class="p-4 border rounded mb-3">
                    <div class="font-bold">
                        {{ $item->profesiKerja->nama_profesi_kerja }}
                    </div>
                    <div class="text-sm text-slate-600">
                        Skor: {{ $item->total_poin }}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- JURUSAN --}}
        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4">Top 3 Jurusan</h3>

            @foreach ($jurusan as $item)
                <div class="p-4 border rounded mb-3">
                    <div class="font-bold">
                        {{ $item->jurusanKuliah->nama_jurusan_kuliah }}
                    </div>
                    <div class="text-sm text-slate-600">
                        Skor: {{ $item->total_poin }}
                    </div>
                </div>
            @endforeach
        </div>

    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
