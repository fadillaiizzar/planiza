@extends('layouts.admin')

@section('title', 'Hasil Rekomendasi SDGs - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">

        <x-admin.breadcrumb :links="[
            ['href' => route('admin.sdgs.index'), 'icon' => 'fas fa-leaf', 'title' => 'SDGs'],
            ['href' => '#', 'icon' => 'fas fas fa-seedling', 'title' => 'Hasil Kontribusi'],
        ]" />

        @component('admin.sdgs.hasil_kontribusi.section', [
            'pageTitle' => 'Manajemen Hasil Kontribusi SDGs',
            'stats' => [
                ['label' => 'Total Rekomendasi', 'count' => $hasilKontribusiCount, 'icon' => 'fas fa-briefcase', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Total Profesi', 'count' => $totalProfesi, 'icon' => 'fas fa-briefcase', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Total Jurusan', 'count' => $totalJurusan, 'icon' => 'fas fa-university', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
            ],
            'tableHeaders' => ['No', 'Nama', 'Kelas', 'Tanggal', 'Aksi'],
            'items' => $items
        ])
        @endcomponent

    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
