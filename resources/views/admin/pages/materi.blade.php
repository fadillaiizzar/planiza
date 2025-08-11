@extends('layouts.admin')

@section('title', 'Manajemen Materi - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <div class="flex justify-center mb-8 gap-4 flex-wrap">
            <button id="btnTopik"
                class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300
                    bg-gradient-to-r from-slate-navy to-cool-gray text-off-white
                    hover:scale-105 hover:from-cool-gray hover:to-slate-navy
                    focus:ring-4 focus:ring-cool-gray">
                📚 Topik Materi
            </button>

            <button id="btnMateri"
                class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300
                    bg-off-white text-slate-navy border border-border-gray
                    hover:bg-cool-gray hover:text-off-white hover:scale-105
                    focus:ring-4 focus:ring-border-gray">
                📄 Materi
            </button>
        </div>

        @component('admin.components.materi.section', [
            'id' => 'sectionTopik',
            'pageTitle' => 'Topik Materi Management',
            'addButtonText' => 'Tambah Topik',
            'addUserRoute' => route('admin.materi.create'),
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Topik', 'count' => $materiCount, 'icon' => 'fas fa-book', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Topik per Kelas', 'count' => $materiPerKelas->sum(), 'icon' => 'fas fa-layer-group', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                ['label' => 'Topik per Jurusan', 'count' => $materiPerJurusan->sum(), 'icon' => 'fas fa-university', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
                ['label' => 'Topik per Rencana', 'count' => $materiPerRencana->sum(), 'icon' => 'fas fa-tasks', 'bg' => 'from-yellow-500 to-yellow-600', 'textColor' => 'text-yellow-100'],
            ],
            'statistikTitle' => 'Statistik Topik',
            'iconKelas' => '📚',
            'labelKelas' => 'Topik per Kelas',
            'iconJurusan' => '🏫',
            'labelJurusan' => 'Topik per Jurusan',
            'iconRencana' => '🗂',
            'labelRencana' => 'Topik per Rencana',
            'dataPerKelas' => $materiPerKelas,
            'dataPerJurusan' => $materiPerJurusan,
            'dataPerRencana' => $materiPerRencana,
            'tableTitle' => 'Daftar Topik Materi',
            'tableHeaders' => ['ID', 'Judul Topik', 'Kelas', 'Jurusan', 'Rencana', 'Aksi'],
            'items' => $topikMateris,
        ])
        @endcomponent

        @component('admin.components.materi.section', [
            'id' => 'sectionMateri',
            'hidden' => 'hidden',
            'pageTitle' => 'Materi Management',
            'addButtonText' => 'Tambah Materi',
            'addUserRoute' => route('admin.materi.create'),
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Materi', 'count' => $materiCount, 'icon' => 'fas fa-book', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Materi per Kelas', 'count' => $materiPerKelas->sum(), 'icon' => 'fas fa-layer-group', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                ['label' => 'Materi per Jurusan', 'count' => $materiPerJurusan->sum(), 'icon' => 'fas fa-university', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
                ['label' => 'Materi per Rencana', 'count' => $materiPerRencana->sum(), 'icon' => 'fas fa-tasks', 'bg' => 'from-yellow-500 to-yellow-600', 'textColor' => 'text-yellow-100'],
            ],
            'statistikTitle' => 'Statistik Materi',
            'iconKelas' => '📚',
            'labelKelas' => 'Materi per Kelas',
            'iconJurusan' => '🏫',
            'labelJurusan' => 'Materi per Jurusan',
            'iconRencana' => '🗂',
            'labelRencana' => 'Materi per Rencana',
            'dataPerKelas' => $materiPerKelas,
            'dataPerJurusan' => $materiPerJurusan,
            'dataPerRencana' => $materiPerRencana,
            'tableTitle' => 'Daftar Materi',
            'tableHeaders' => ['ID', 'Judul Materi', 'Kelas', 'Jurusan', 'Rencana', 'Aksi'],
            'items' => $topikMateris,
        ])
        @endcomponent

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $topikMateris->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const btnTopik = document.getElementById('btnTopik');
        const btnMateri = document.getElementById('btnMateri');
        const sectionTopik = document.getElementById('sectionTopik');
        const sectionMateri = document.getElementById('sectionMateri');

        btnTopik.addEventListener('click', () => {
            sectionTopik.classList.remove('hidden');
            sectionMateri.classList.add('hidden');
            btnTopik.classList.add('bg-blue-600', 'text-white');
            btnTopik.classList.remove('bg-gray-200', 'text-gray-700');
            btnMateri.classList.remove('bg-blue-600', 'text-white');
            btnMateri.classList.add('bg-gray-200', 'text-gray-700');
        });

        btnMateri.addEventListener('click', () => {
            sectionMateri.classList.remove('hidden');
            sectionTopik.classList.add('hidden');
            btnMateri.classList.add('bg-blue-600', 'text-white');
            btnMateri.classList.remove('bg-gray-200', 'text-gray-700');
            btnTopik.classList.remove('bg-blue-600', 'text-white');
            btnTopik.classList.add('bg-gray-200', 'text-gray-700');
        });

        btnTopik.addEventListener('click', () => {
            sectionTopik.classList.remove('hidden');
            sectionMateri.classList.add('hidden');

            btnTopik.className = "px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-gradient-to-r from-slate-navy to-cool-gray text-off-white hover:scale-105 hover:from-cool-gray hover:to-slate-navy focus:ring-4 focus:ring-cool-gray";
            btnMateri.className = "px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-off-white text-slate-navy border border-border-gray hover:bg-cool-gray hover:text-off-white hover:scale-105 focus:ring-4 focus:ring-border-gray";
        });

        btnMateri.addEventListener('click', () => {
            sectionMateri.classList.remove('hidden');
            sectionTopik.classList.add('hidden');

            btnMateri.className = "px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-gradient-to-r from-slate-navy to-cool-gray text-off-white hover:scale-105 hover:from-cool-gray hover:to-slate-navy focus:ring-4 focus:ring-cool-gray";
            btnTopik.className = "px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-off-white text-slate-navy border border-border-gray hover:bg-cool-gray hover:text-off-white hover:scale-105 focus:ring-4 focus:ring-border-gray";
        });

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
