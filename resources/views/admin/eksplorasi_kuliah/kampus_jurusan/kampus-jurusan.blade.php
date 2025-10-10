@extends('layouts.admin')

@section('title', 'Manajemen Kampus Jurusan - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.eksplorasi-jurusan.kampus-jurusan.index'), 'icon' => 'fas fa-university', 'title' => 'Eksplorasi Kuliah'],
            ['href' => '#', 'icon' => 'fas fa-graduation-cap', 'title' => 'Kampus Jurusan'],
        ]" />

        @component('admin.eksplorasi_kuliah.kampus_jurusan.section', [
            'id' => 'sectionKampusJurusan',
            'pageTitle' => 'Manajemen Kampus Jurusan',
            'addButtonText' => 'Tambah Relasi',
            'stats' => [
                ['label' => 'Total Relasi', 'count' => $relasiCount, 'icon' => 'fas fa-link', 'bg' => 'from-indigo-500 to-indigo-600', 'textColor' => 'text-indigo-100'],
                ['label' => 'Total Kampus', 'count' => $kampusCount, 'icon' => 'fas fa-university', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                ['label' => 'Total Jurusan', 'count' => $jurusanKuliahCount, 'icon' => 'fas fa-book', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan kampus atau jurusan',
            'itemCount' =>  $relasiCount,
            'statistikTitle' => 'Statistik Relasi Kampus - Jurusan Kuliah',
            'iconKampus' => '🎓',
            'labelKampus' => 'Kampus',
            'iconJurusan' => '📚',
            'labelJurusan' => 'Jurusan',
            'jurusanPerKampus' => $jurusanPerKampus,
            'kampusPerJurusan' => $kampusPerJurusan,
            'tableTitle' => 'Daftar Relasi Kampus - Jurusan Kuliah',
            'tableHeaders' => ['ID', 'Nama Kampus', 'Nama Jurusan', 'Passing Grade', 'Aksi'],
            'items' => $allRelations,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.eksplorasi_kuliah.kampus_jurusan.create', [
                'kampus' => $kampus,
                'jurusanKuliahs' => $jurusanKuliahs,
            ])
        </div>

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
