@extends('layouts.admin')

@section('title', 'Manajemen Kategori Minat - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.kenali-profesi'), 'icon' => 'fas fa-user-tie', 'title' => 'Kenali Profesi'],
            ['href' => '#', 'icon' => 'fas fa-tags', 'title' => 'Kategori Minat'],
        ]" />

        @component('admin.kenali_profesi.kategori_minat.section', [
            'id' => 'sectionKategoriMinat',
            'pageTitle' => 'Kategori Minat Management',
            'addButtonText' => 'Tambah Kategori',
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Kategori Minat', 'count' => $kategoriMinatCount, 'icon' => 'fas fa-book', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan nama kategori',
            'itemCount' =>  $kategoriMinatCount,
            'tableTitle' => 'Daftar Kategori Minat',
            'tableHeaders' => ['ID', 'Nama Kategori', 'Deskripsi', 'Aksi'],
            'items' => $kategoriMinats,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.kenali_profesi.kategori_minat.create')
        </div>

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $kategoriMinats->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
