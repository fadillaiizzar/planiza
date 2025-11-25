@extends('layouts.admin')

@section('title', 'Manajemen Hubungan SDGs - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.sdgs.index'), 'icon' => 'fas fa-leaf', 'title' => 'SDGs'],
            ['href' => '#', 'icon' => 'fas fa-project-diagram', 'title' => 'Hubungan SDGs'],
        ]" />

        @component('admin.sdgs.hubungan_sdgs.section', [
            'id' => 'sectionHubunganSdgs',
            'pageTitle' => 'Manajemen Hubungan SDGs',
            'addButtonText' => 'Tambah Relasi',
            'stats' => [
                ['label' => 'Total Relasi', 'count' => $relasiCount ?? 0, 'icon' => 'fas fa-project-diagram', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
                ['label' => 'Total Kategori', 'count' => $kategoriCount ?? 0, 'icon' => 'fas fa-folder-open', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Total Profesi', 'count' => $profesiCount ?? 0, 'icon' => 'fas fa-briefcase', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                ['label' => 'Total Jurusan', 'count' => $jurusanCount ?? 0, 'icon' => 'fas fa-user-graduate', 'bg' => 'from-orange-500 to-orange-600', 'textColor' => 'text-orange-100'],
            ],
            'filterOptions' => $filterOptions ?? [],
            'searchPlaceholder' => 'Cari berdasarkan kategori, profesi, atau jurusan',
            'itemCount' => $relasiCount,
            'statistikTitle' => 'Statistik Hubungan SDGs',
            'labelProfesi' => 'Profesi per Kategori',
            'labelJurusan' => 'Jurusan per Kategori',
            'profesiPerKategori' => $profesiPerKategori,
            'jurusanPerKategori' => $jurusanPerKategori,
            'tableTitle' => 'Daftar Hubungan SDGs',
            'tableHeaders' => ['ID', 'Kategori SDGs', 'Profesi', 'Jurusan', 'Created At', 'Aksi'],
            'items' => $allRelations,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.sdgs.hubungan_sdgs.create', [
                'kategoriSdgs' => $kategoriSdgs,
                'profesis' => $profesis,
                'jurusans' => $jurusans,
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
