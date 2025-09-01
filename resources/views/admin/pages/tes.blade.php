@extends('layouts.admin')

@section('title', 'Manajemen Tes - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.kenali-profesi.index'), 'icon' => 'fas fa-user-tie', 'title' => 'Kenali Profesi'],
            ['href' => '#', 'icon' => 'fas fa-vial', 'title' => 'Tes'],
        ]" />

        @component('admin.kenali_profesi.tes.section', [
            'id' => 'sectionTes',
            'pageTitle' => 'Tes Management',
            'addButtonText' => 'Tambah Tes',
            'userCount' => $tesCount,
            'stats' => [
                ['label' => 'Total Tes', 'count' => $tesCount, 'icon' => 'fas fa-vial', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan nama tes',
            'itemCount' =>  $tesCount,
            'tableTitle' => 'Daftar Tes',
            'tableHeaders' => ['ID', 'Nama Tes', 'Aksi'],
            'items' => $tes,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.kenali_profesi.tes.create')
        </div>

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $tes->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
