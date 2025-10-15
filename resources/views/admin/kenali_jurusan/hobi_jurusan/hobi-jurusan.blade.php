@extends('layouts.admin')

@section('title', 'Manajemen Hobi Jurusan - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.kenali-jurusan.index'), 'icon' => 'fas fa-heart', 'title' => 'Kenali Jurusan'],
            ['href' => '#', 'icon' => 'fas fa-book', 'title' => 'Hobi Jurusan'],
        ]" />

        @component('admin.kenali_jurusan.hobi_jurusan.section', [
            'id' => 'sectionHobiJurusan',
            'pageTitle' => 'Manajemen Hobi Jurusan',
            'addButtonText' => 'Tambah Relasi',
            'stats' => [
                ['label' => 'Total Relasi', 'count' => $relasiCount, 'icon' => 'fas fa-link', 'bg' => 'from-indigo-500 to-indigo-600', 'textColor' => 'text-indigo-100'],
                ['label' => 'Total Hobi', 'count' => $hobiCount, 'icon' => 'fas fa-heart', 'bg' => 'from-pink-500 to-pink-600', 'textColor' => 'text-pink-100'],
                ['label' => 'Total Jurusan', 'count' => $jurusanCount, 'icon' => 'fas fa-book', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan hobi atau jurusan',
            'itemCount' =>  $relasiCount,
            'statistikTitle' => 'Statistik Relasi Hobi - Jurusan',
            'iconHobi' => '❤️',
            'labelHobi' => 'Hobi',
            'iconJurusan' => '📚',
            'labelJurusan' => 'Jurusan',
            'jurusanPerHobi' => $jurusanPerHobi,
            'hobiPerJurusan' => $hobiPerJurusan,
            'tableTitle' => 'Daftar Relasi Hobi - Jurusan',
            'tableHeaders' => ['ID', 'Nama Hobi', 'Nama Jurusan', 'Poin', 'Aksi'],
            'items' => $allRelations,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.kenali_jurusan.hobi_jurusan.create', [
                'hobis' => $hobis,
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
