@extends('layouts.admin')

@section('title', 'Manajemen Topik Materi - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.pembelajaran.index'), 'icon' => 'fas fa-book', 'title' => 'Pembelajaran'],
            ['href' => '#', 'icon' => 'fas fa-layer-group', 'title' => 'Topik Materi'],
        ]" />

        @component('admin.materi.topik.section', [
            'id' => 'sectionTopik',
            'pageTitle' => 'Topik Materi Management',
            'addButtonText' => 'Tambah Topik',
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Topik', 'count' => $topikMaterisCount, 'icon' => 'fas fa-layer-group', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Topik per Kelas', 'count' => $materiPerKelas->sum(), 'icon' => 'fas fa-user-graduate', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                ['label' => 'Topik per Jurusan', 'count' => $materiPerJurusan->sum(), 'icon' => 'fas fa-school', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
                ['label' => 'Topik per Rencana', 'count' => $materiPerRencana->sum(), 'icon' => 'fas fa-tasks', 'bg' => 'from-yellow-500 to-yellow-600', 'textColor' => 'text-yellow-100'],
            ],
           'filterOptions' => [
                ['label' => 'X', 'value' => 'X'],
                ['label' => 'XI', 'value' => 'XI'],
                ['label' => 'XII', 'value' => 'XII'],
                ['label' => 'XIII', 'value' => 'XIII'],
            ],
            'searchPlaceholder' => 'Cari berdasarkan judul topik',
            'itemCount' =>  $topikMaterisCount,
            'statistikTitle' => 'Statistik Topik',
            'iconKelas' => '',
            'labelKelas' => 'Topik per Kelas',
            'iconJurusan' => '',
            'labelJurusan' => 'Topik per Jurusan',
            'iconRencana' => '',
            'labelRencana' => 'Topik per Rencana',
            'materiPerKelas' => $materiPerKelas,
            'materiPerJurusan' => $materiPerJurusan,
            'materiPerRencana' => $materiPerRencana,
            'tableTitle' => 'Daftar Topik Materi',
            'tableHeaders' => ['ID', 'Judul Topik', 'Kelas', 'Jurusan', 'Rencana', 'Aksi'],
            'items' => $topikMateris,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.materi.topik.create', [
                'kelas' => $kelas,
                'jurusan' => $jurusan,
                'rencana' => $rencana,
            ])
        </div>

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $topikMateris->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
