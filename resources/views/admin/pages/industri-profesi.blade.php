@extends('layouts.admin')

@section('title', 'Manajemen Industri Profesi - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.eksplorasi-profesi.index'), 'icon' => 'fas fa-tools', 'title' => 'Eksplorasi Profesi'],
            ['href' => '#', 'icon' => 'fas fa-project-diagram', 'title' => 'Industri Profesi'],
        ]" />

        @component('admin.eksplorasi_kerja.industri_profesi.section', [
            'id' => 'sectionIndustriProfesi',
            'pageTitle' => 'Manajemen Industri Profesi',
            'addButtonText' => 'Tambah Relasi',
            'stats' => [
                ['label' => 'Total Relasi', 'count' => $relasiCount, 'icon' => 'fas fa-project-diagram', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
                ['label' => 'Total Profesi', 'count' => $profesiCount, 'icon' => 'fas fa-briefcase', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Total Industri', 'count' => $industriCount, 'icon' => 'fas fa-industry', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan industri atau profesi',
            'itemCount' =>  $relasiCount,
            'statistikTitle' => 'Statistik Relasi Industri - Profesi',
            'iconIndustri' => '🏭',
            'labelIndustri' => 'Industri',
            'iconProfesi' => '👨‍💼',
            'labelProfesi' => 'Profesi',
            'profesiPerIndustri' => $profesiPerIndustri,
            'industriPerProfesi' => $industriPerProfesi,
            'tableTitle' => 'Daftar Relasi Industri - Profesi',
            'tableHeaders' => ['ID', 'Nama Profesi', 'Industri Terkait', 'Aksi'],
            'items' => $allRelations,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.eksplorasi_kerja.industri_profesi.create', [
                'industris' => $industris,
                'profesis' => $profesis,
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
