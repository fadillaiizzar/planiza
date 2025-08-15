@extends('layouts.admin')

@section('title', 'Manajemen Materi - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <div class="flex justify-center mb-8 gap-4 flex-wrap">
            <a href="{{ route('admin.topik.materi.index') }}" class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-off-white text-slate-navy border border-border-gray hover:bg-cool-gray hover:text-off-white hover:scale-105 focus:ring-4 focus:ring-border-gray">
                📚 Topik Materi
            </a>

            <a href="{{ route('admin.materi.index') }}" class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-gradient-to-r from-slate-navy to-cool-gray text-off-white hover:scale-105 hover:from-cool-gray hover:to-slate-navy focus:ring-4 focus:ring-cool-gray">
                📄 Materi
            </a>
        </div>

        @component('admin.materi.materi.section', [
            'id' => 'sectionMateri',
            'pageTitle' => 'Materi Management',
            'addButtonText' => 'Tambah Materi',
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Materi', 'count' => $materisCount, 'icon' => 'fas fa-book', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Materi per Kelas', 'count' => $materiPerKelas->sum(), 'icon' => 'fas fa-layer-group', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                ['label' => 'Materi per Jurusan', 'count' => $materiPerJurusan->sum(), 'icon' => 'fas fa-university', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
                ['label' => 'Materi per Rencana', 'count' => $materiPerRencana->sum(), 'icon' => 'fas fa-tasks', 'bg' => 'from-yellow-500 to-yellow-600', 'textColor' => 'text-yellow-100'],
            ],
           'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan nama materi',
            'itemCount' =>  $materisCount,
            'statistikTitle' => 'Statistik Materi',
            'iconKelas' => '📚',
            'labelKelas' => 'Materi per Kelas',
            'iconJurusan' => '🏫',
            'labelJurusan' => 'Materi per Jurusan',
            'iconRencana' => '🗂',
            'labelRencana' => 'Materi per Rencana',
            'materiPerKelas' => $materiPerKelas,
            'materiPerJurusan' => $materiPerJurusan,
            'materiPerRencana' => $materiPerRencana,
            'tableTitle' => 'Daftar Materi',
            'tableHeaders' => ['ID', 'Nama Materi', 'Topik', 'Deskripsi Materi', 'Tipe File', 'File Materi', 'Aksi'],
            'items' => $materis,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.materi.materi.create', ['topikMateriList' => $topikMateriList])
        </div>

        <!-- Modal Edit -->
        <div id="modalEditMateri" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEditMateri" class="w-full mx-auto flex items-center justify-center"></div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $materis->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function toggleDropdown(id) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(drop => {
                if (drop.id === `dropdown-${id}`) {
                    drop.classList.toggle('hidden');
                } else {
                    drop.classList.add('hidden');
                }
            });
        }
    </script>
@endpush
