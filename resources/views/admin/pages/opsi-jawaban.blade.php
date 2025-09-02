@extends('layouts.admin')

@section('title', 'Manajemen Opsi Jawaban - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <x-admin.breadcrumb :links="[
            ['href' => route('admin.kenali-profesi.index'), 'icon' => 'fas fa-user-tie', 'title' => 'Kenali Profesi'],
            ['href' => '#', 'icon' => 'fas fa-list-ul', 'title' => 'Opsi Jawaban'],
        ]" />

        @component('admin.kenali_profesi.opsi_jawaban.section', [
            'id' => 'sectionOpsiJawaban',
            'pageTitle' => 'Opsi Jawaban Management',
            'addButtonText' => 'Tambah Opsi Jawaban',
            'addRoute' => 'admin.kenali-profesi.opsi-jawaban.create',
            'userCount' => $opsiJawabanCount,
            'stats' => [
                ['label' => 'Total Opsi Jawaban', 'count' => $opsiJawabanCount, 'icon' => 'fas fa-list-ul', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
            ],
            'filterOptions' => $filterOptions,
            'searchPlaceholder' => 'Cari berdasarkan opsi jawaban',
            'itemCount' => $opsiJawabanCount,
            'tableTitle' => 'Daftar Opsi Jawaban',
            'tableHeaders' => ['ID', 'Soal Tes', 'Isi Opsi', 'Poin', 'Kategori / Profesi', 'Jumlah', 'Aksi'],
            'items' => $opsiJawaban,
        ])
        @endcomponent

        <!-- Modal Edit -->
        <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            <div id="modalContentEdit" class="w-full mx-auto flex items-center justify-center"></div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/30">
            {{ $opsiJawaban->links() }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
