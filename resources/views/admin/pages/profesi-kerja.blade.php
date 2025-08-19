@extends('layouts.admin')

@section('title', 'Manajemen Profesi Kerja - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <div class="flex justify-center mb-8 gap-4 flex-wrap">
            <a href="{{ route('admin.profesi-kerja.index') }}"
            class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-gradient-to-r from-slate-navy to-cool-gray text-off-white hover:scale-105 hover:from-cool-gray hover:to-slate-navy focus:ring-4 focus:ring-cool-gray">
                <i class="fas fa-briefcase w-5 h-5 mr-2"></i>
                Profesi Kerja
            </a>

            <a href="#"
            class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-off-white text-slate-navy border border-border-gray hover:bg-cool-gray hover:text-off-white hover:scale-105 focus:ring-4 focus:ring-border-gray">
                <i class="fas fa-industry w-5 h-5 mr-2"></i>
                Industri
            </a>

            <a href="#"
            class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-off-white text-slate-navy border border-border-gray hover:bg-cool-gray hover:text-off-white hover:scale-105 focus:ring-4 focus:ring-border-gray">
                <i class="fas fa-project-diagram w-5 h-5 mr-2"></i>
                Industri Profesi
            </a>
        </div>

        @component('admin.eksplorasi_kerja.profesi_kerja.section', [
            'id' => 'sectionProfesi',
            'pageTitle' => 'Manajemen Profesi Kerja',
            'addButtonText' => 'Tambah Profesi',
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Profesi', 'count' => $profesiCount, 'icon' => 'fas fa-briefcase', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Profesi dengan Industri', 'count' => $allProfesi->where('industris')->count(), 'icon' => 'fas fa-industry', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
            ],
            'searchPlaceholder' => 'Cari berdasarkan nama profesi',
            'itemCount' => $profesiCount,
            'statistikTitle' => 'Statistik Profesi',
            'iconKelas' => '💼',
            'labelKelas' => 'Profesi per Industri',
            'allProfesi' => $allProfesi,
            'tableTitle' => 'Daftar Profesi Kerja',
            'tableHeaders' => ['ID', 'Nama Profesi', 'Gambar', 'Gaji', 'Deskripsi', 'Skill', 'Jurusan', 'Aksi'],
            'items' => $profesiKerjas,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.eksplorasi_kerja.profesi_kerja.create')
        </div>

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $profesiKerjas->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
