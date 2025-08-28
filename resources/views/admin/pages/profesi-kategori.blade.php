@extends('layouts.admin')

@section('title', 'Manajemen Profesi Kategori - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.kenali-profesi.index'), 'icon' => 'fas fa-user-tie', 'title' => 'Kenali Profesi'],
            ['href' => '#', 'icon' => 'fas fa-clipboard-check', 'title' => 'Profesi Kategori'],
        ]" />

        @component('admin.kenali_profesi.profesi_kategori.section', [
            'id' => 'sectionProfesiKategori',
            'pageTitle' => 'Manajemen Profesi Kategori',
            'addButtonText' => 'Tambah Relasi',
            'stats' => [
                ['label' => 'Total Relasi', 'count' => $relasiCount, 'icon' => 'fas fa-clipboard-check', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
                ['label' => 'Total Profesi', 'count' => $profesiCount, 'icon' => 'fas fa-briefcase', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Total Kategori Minat', 'count' => $kategoriMinatCount, 'icon' => 'fas fa-layer-group', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan profesi atau kategori minat',
            'itemCount' => $relasiCount,
            'statistikTitle' => 'Statistik Relasi Profesi - Kategori Minat',
            'iconProfesi' => '👨‍💼',
            'labelProfesi' => 'Profesi',
            'iconKategori' => '📚',
            'labelKategori' => 'Kategori Minat',
            'profesiKategori' => $profesiKategori,
            'kategoriProfesi' => $kategoriProfesi,
            'tableTitle' => 'Daftar Relasi Profesi - Kategori Minat',
            'tableHeaders' => ['ID', 'Nama Profesi', 'Kategori Minat', 'Aksi'],
            'items' => $allRelations,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.kenali_profesi.profesi_kategori.create', [
                'profesis' => $profesis,
                'kategoriMinats' => $kategoriMinats,
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
