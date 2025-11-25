@extends('layouts.admin')

@section('title', 'Manajemen Hasil Form - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.kenali-jurusan.index'), 'icon' => 'fas fa-user-graduate', 'title' => 'Kenali Jurusan'],
            ['href' => '#', 'icon' => 'fas fa-file-alt', 'title' => 'Hasil Form'],
        ]" />

        @component('admin.kenali_jurusan.hasil_form.section', [
            'pageTitle' => 'Manajemen Hasil Form Kuliah',
            'userCount' => $totalUser,
            'stats' => [
                ['label' => 'Total User', 'count' => $totalUser, 'icon' => 'fas fa-users', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Total Pengerjaan', 'count' => $totalPengerjaan, 'icon' => 'fas fa-sync-alt', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
            ],
            'filterOptions' => [],
            'searchPlaceholder' => 'Cari berdasarkan nama user',
            'itemCount' => $items->count(),
            'tableTitle' => 'Daftar Hasil Form Kuliah',
            'tableHeaders' => ['No', 'Nama User', 'Kelas', 'Jumlah Pengerjaan', 'Update Terakhir', 'Aksi'],
            'items' => $items,
        ])
        @endcomponent
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
