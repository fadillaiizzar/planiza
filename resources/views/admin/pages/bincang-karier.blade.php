@extends('layouts.admin')

@section('title', 'Bincang Karier - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        @component('admin.bincang_karier.section', [
            'pageTitle' => 'Manajemen Bincang Karier',
            'addButtonText' => 'Tambah Pertanyaan',
            'stats' => [
                ['label' => 'Total Pertanyaan', 'count' => $bincangKarier->total(), 'icon' => 'fas fa-question-circle', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
            ],
            'filterOptions' => [],
            'searchPlaceholder' => 'Cari pertanyaan...',
            'items' => $bincangKarier,
            'tableHeaders' => ['No', 'Nama', 'Pertanyaan', 'Jumlah Tanggapan', 'Tanggal', 'Aksi'],
        ])
        @endcomponent

        <!-- Modal Create -->
        <div id="modalCreate" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
            @include('admin.bincang_karier.create')
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $bincangKarier->links() }}
            <x-paginate :items="$bincangKarier" />
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
