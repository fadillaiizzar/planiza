@extends('layouts.admin')

@section('title', 'Dashboard Admin - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 p-6">
        <div class="md:hidden flex justify-between items-center mb-4">
            <button onclick="toggleSidebar()" class="text-2xl">
                <i class="fas fa-bars"></i>
            </button>
            <a href="{{ route('register') }}" class="text-xl text-slate-navy hover:text-blue-600">
                <i class="fas fa-user-plus"></i>
            </a>
        </div>

        <div class="hidden md:flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Selamat Datang, {{ $user->name }} 👋</h2>
            {{-- <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-slate-navy hover:bg-slate-navy hover:text-white border border-slate-navy rounded transition">
                Tambah Akun
            </a> --}}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-cool-gray">Total User</p>
                <h3 class="text-2xl font-bold">{{ $userCount }}</h3>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-cool-gray">Jumlah Materi</p>
                <h3 class="text-2xl font-bold">{{ $materiCount }}</h3>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-cool-gray">Jumlah Eksplorasi</p>
                <h3 class="text-2xl font-bold">{{ $eksplorasiCount }}</h3>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-xl font-semibold mb-4">Aktivitas Terbaru</h3>
            <table class="w-full table-auto text-left">
                <thead>
                    <tr class="border-b border-border-gray text-cool-gray">
                        <th class="p-2">Waktu</th>
                        <th class="p-2">Nama</th>
                        <th class="p-2">Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aktivitas as $log)
                    <tr class="border-b hover:bg-off-white">
                        <td class="p-2 text-sm">{{ $log->created_at->format('d M Y H:i') }}</td>
                        <td class="p-2 text-sm">{{ $log->user?->name ?? '-' }}</td>
                        <td class="p-2 text-sm">{{ $log->aktivitas }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
