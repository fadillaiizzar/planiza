@extends('layouts.admin')

@section('title', 'Manajemen Hobi - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.kenali-jurusan.index'), 'icon' => 'fas fa-user-graduate', 'title' => 'Kenali Jurusan'],
            ['href' => '#', 'icon' => 'fas fa-heart', 'title' => 'Hobi'],
        ]" />

        @component('admin.kenali_jurusan.hobi.section', [
            'id' => 'sectionHobi',
            'pageTitle' => 'Hobi Management',
            'addButtonText' => 'Tambah Hobi',
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Hobi', 'count' => $hobiCount, 'icon' => 'fas fa-heart', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
            ],
            'filterOptions' => [],
            'searchPlaceholder' => 'Cari berdasarkan nama hobi',
            'itemCount' =>  $hobiCount,
            'tableTitle' => 'Daftar Hobi',
            'tableHeaders' => ['ID', 'Nama Hobi', 'Aksi'],
            'items' => $hobis,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.kenali_jurusan.hobi.create')
        </div>

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $hobis->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
