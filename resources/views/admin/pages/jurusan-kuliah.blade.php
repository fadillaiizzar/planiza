@extends('layouts.admin')

@section('title', 'Manajemen Jurusan Kuliah - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.eksplorasi-jurusan.index'), 'icon' => 'fas fa-graduation-cap', 'title' => 'Eksplorasi Kuliah'],
            ['href' => '#', 'icon' => 'fas fa-book', 'title' => 'Jurusan Kuliah'],
        ]" />

        @component('admin.eksplorasi_kuliah.jurusan_kuliah.section', [
            'id' => 'sectionJurusan',
            'pageTitle' => 'Manajemen Jurusan Kuliah',
            'addButtonText' => 'Tambah Jurusan',
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Jurusan Kuliah', 'count' => $jurusanKuliahCount, 'icon' => 'fas fa-graduation-cap', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
            ],
            'searchPlaceholder' => 'Cari berdasarkan nama jurusan kuliah',
            'itemCount' => $jurusanKuliahCount,
            'tableTitle' => 'Daftar Jurusan Kuliah',
            'tableHeaders' => ['ID', 'Nama Jurusan', 'Gambar', 'Deskripsi', 'Mata Kuliah', 'Prospek', 'Aksi'],
            'items' => $jurusanKuliahs,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.eksplorasi_kuliah.jurusan_kuliah.create')
        </div>

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $jurusanKuliahs->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
