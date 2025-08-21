@extends('layouts.admin')

@section('title', 'Manajemen Industri Profesi - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <div class="flex justify-center mb-8 gap-4 flex-wrap">
            <a href="{{ route('admin.profesi-kerja.index') }}"
               class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-off-white text-slate-navy border border-border-gray hover:bg-cool-gray hover:text-off-white hover:scale-105 focus:ring-4 focus:ring-border-gray">
                <i class="fas fa-briefcase w-5 h-5 mr-2"></i>
                Profesi Kerja
            </a>

            <a href="{{ route('admin.industri.index') }}"
               class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-off-white text-slate-navy border border-border-gray hover:bg-cool-gray hover:text-off-white hover:scale-105 focus:ring-4 focus:ring-border-gray">
                <i class="fas fa-industry w-5 h-5 mr-2"></i>
                Industri
            </a>

            <a href="{{ route('admin.industri-profesi.index') }}"
               class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-gradient-to-r from-slate-navy to-cool-gray text-off-white hover:scale-105 hover:from-cool-gray hover:to-slate-navy focus:ring-4 focus:ring-cool-gray">
                <i class="fas fa-project-diagram w-5 h-5 mr-2"></i>
                Industri Profesi
            </a>
        </div>

        @component('admin.eksplorasi_kerja.industri_profesi.section', [
            'id' => 'sectionIndustriProfesi',
            'pageTitle' => 'Manajemen Industri Profesi',
            'addButtonText' => 'Tambah Relasi',
            'stats' => [
                ['label' => 'Total Relasi', 'count' => $relasiCount, 'icon' => 'fas fa-link', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
                ['label' => 'Total Profesi', 'count' => $profesiCount, 'icon' => 'fas fa-briefcase', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Total Industri', 'count' => $industriCount, 'icon' => 'fas fa-industry', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
            ],
            'searchPlaceholder' => 'Cari berdasarkan industri atau profesi',
            'itemCount' =>  $relasiCount,
            'statistikTitle' => 'Statistik Industri - Profesi',
            'iconIndustri' => '🏭',
            'labelIndustri' => 'Industri',
            'iconProfesi' => '👨‍💼',
            'labelProfesi' => 'Profesi',
            'profesiPerIndustri' => $profesiPerIndustri,
            'industriPerProfesi' => $industriPerProfesi,
            'tableTitle' => 'Daftar Relasi Industri - Profesi',
            'tableHeaders' => ['ID', 'Nama Profesi', 'Industri Terkait', 'Aksi'],
            'items' => $allRelations,
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.eksplorasi_kerja.industri_profesi.create', [
                'industris' => $industris,
                'profesis' => $profesis,
            ])
        </div>

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
