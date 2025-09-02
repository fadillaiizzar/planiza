@extends('layouts.admin')

@section('title', 'Manajemen Soal Tes - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.kenali-profesi.index'), 'icon' => 'fas fa-user-tie', 'title' => 'Kenali Profesi'],
            ['href' => '#', 'icon' => 'fas fa-list-ul', 'title' => 'Soal Tes'],
        ]" />

        @component('admin.kenali_profesi.soal_tes.section', [
            'id' => 'sectionSoalTes',
            'pageTitle' => 'Soal Tes Management',
            'addButtonText' => 'Tambah Soal Tes',
            'addRoute' => 'admin.kenali-profesi.soal-tes.create',
            'userCount' => $tesCount,
            'stats' => [
                ['label' => 'Total Tes', 'count' => $tesCount, 'icon' => 'fas fa-list-ul', 'bg' => 'from-indigo-500 to-indigo-600', 'textColor' => 'text-indigo-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan pertanyaan',
            'itemCount' => $tesCount,
            'tableTitle' => 'Daftar Soal Tes',
            'tableHeaders' => ['No', 'Nama Tes', 'Jumlah Soal', 'Aksi'],
            'tesList' => $tesList,
        ])
        @endcomponent

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $tesList->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
