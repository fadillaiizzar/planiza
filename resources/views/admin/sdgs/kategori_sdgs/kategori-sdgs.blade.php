@extends('layouts.admin')

@section('title', 'Manajemen Kategori SDGs - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-green-50 to-emerald-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.sdgs.kategori-sdgs.index'), 'icon' => 'fas fa-globe', 'title' => 'SDGs'],
            ['href' => '#', 'icon' => 'fas fa-folder-open', 'title' => 'Kategori SDGs'],
        ]" />

        @component('admin.sdgs.kategori_sdgs.section', [
            'id' => 'sectionKategoriSdgs',
            'pageTitle' => 'Kategori SDGs Management',
            'addButtonText' => 'Tambah Kategori SDGs',
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Kategori SDGs', 'count' => $kategoriSdgsCount, 'icon' => 'fas fa-globe', 'bg' => 'from-green-500 to-emerald-600', 'textColor' => 'text-green-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan nama kategori SDGs',
            'itemCount' => $kategoriSdgsCount,
            'tableTitle' => 'Daftar Kategori SDGs',
            'tableHeaders' => ['No', 'Nomor Kategori', 'Nama Kategori', 'Deskripsi', 'Aksi'],
            'items' => $kategoriSdgs,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.sdgs.kategori_sdgs.create')
        </div>

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $kategoriSdgs->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
