@extends('layouts.admin')

@section('title', 'Manajemen Profesi Kerja - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.eksplorasi-profesi.index'), 'icon' => 'fas fa-tools', 'title' => 'Eksplorasi Profesi'],
            ['href' => '#', 'icon' => 'fas fa-briefcase', 'title' => 'Profesi Kerja'],
        ]" />

        @component('admin.eksplorasi_kerja.profesi_kerja.section', [
            'id' => 'sectionProfesi',
            'pageTitle' => 'Manajemen Profesi Kerja',
            'addButtonText' => 'Tambah Profesi',
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Profesi', 'count' => $profesiCount, 'icon' => 'fas fa-briefcase', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan nama profesi',
            'itemCount' => $profesiCount,
            'statistikTitle' => 'Statistik Profesi',
            'iconProfesi' => '',
            'labelProfesi' => 'Profesi per Industri',
            'allProfesi' => $allProfesi,
            'tableTitle' => 'Daftar Profesi Kerja',
            'tableHeaders' => ['ID', 'Nama Profesi', 'Gambar', 'Gaji', 'Deskripsi', 'Skill', 'Jurusan', 'Aksi'],
            'items' => $profesiKerjas,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.eksplorasi_kerja.profesi_kerja.create')
        </div>

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $profesiKerjas->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
