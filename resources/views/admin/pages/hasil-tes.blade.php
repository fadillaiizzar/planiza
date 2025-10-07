@extends('layouts.admin')

@section('title', 'Manajemen Hasil Tes - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.kenali-profesi.index'), 'icon' => 'fas fa-user-tie', 'title' => 'Kenali Profesi'],
            ['href' => '#', 'icon' => 'fas fa-list-ul', 'title' => 'Hasil Tes'],
        ]" />

        @component('admin.kenali_profesi.hasil_tes.section', [
            'pageTitle' => 'Manajemen Hasil Tes',
            'userCount' => $tesCount,
            'stats' => [
                ['label' => 'Total Tes', 'count' => $tesCount, 'icon' => 'fas fa-vial', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
                ['label' => 'Total User', 'count' => $totalUser, 'icon' => 'fas fa-users', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Total Pengerjaan', 'count' => $totalPengerjaan, 'icon' => 'fas fa-sync-alt', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan nama tes',
            'itemCount' =>  $tesCount,
            'tableTitle' => 'Daftar Hasil Tes',
            'tableHeaders' => ['No', 'Nama Tes', 'Jumlah User', 'Jumlah Pengerjaan', 'Update Terakhir', 'Aksi'],
            'items' => $data,
        ])
        @endcomponent
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
