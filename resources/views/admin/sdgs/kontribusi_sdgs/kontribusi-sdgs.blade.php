@extends('layouts.admin')

@section('title', 'Kontribusi SDGs - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">

        <x-admin.breadcrumb :links="[
            ['href' => route('admin.sdgs.index'), 'icon' => 'fas fa-globe', 'title' => 'SDGs'],
            ['href' => '#', 'icon' => 'fas fa-globe-asia', 'title' => 'Kontribusi SDGs'],
        ]" />

        @component('admin.sdgs.kontribusi_sdgs.section', [
            'pageTitle' => 'Manajemen Kontribusi SDGs',
            'stats' => [
                ['label' => 'Total Kontribusi', 'count' => $totalKontribusi, 'icon' => 'fas fa-list', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Pending', 'count' => $totalPending, 'icon' => 'fas fa-clock', 'bg' => 'from-yellow-500 to-yellow-600', 'textColor' => 'text-yellow-100'],
                ['label' => 'Approved', 'count' => $totalApproved, 'icon' => 'fas fa-check-circle', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                ['label' => 'Rejected', 'count' => $totalRejected, 'icon' => 'fas fa-times-circle', 'bg' => 'from-red-500 to-red-600', 'textColor' => 'text-red-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari...',
            'items' => $items,
            'tableHeaders' => ['No', 'Nama', 'Kelas', 'Judul', 'SDGs', 'Tanggal', 'Status', 'Aksi'],
        ])
        @endcomponent

    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/admin/kontribusi_sdgs/kontribusi-sdgs.js') }}"></script>
@endpush
