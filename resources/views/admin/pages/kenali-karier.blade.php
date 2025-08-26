@extends('layouts.admin')

@section('title', 'Materi Admin - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <div class="mx-auto max-w-7xl space-y-6">
            <!-- Mobile header -->
            <div class="md:hidden flex justify-between items-center mb-4">
                <div class="flex items-center gap-2">
                    <button onclick="toggleSidebar()" class="text-2xl text-slate-navy hover:text-cool-gray transition-colors">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-lg ml-3 md:ml-0 font-semibold bg-gradient-to-r from-slate-navy to-cool-gray bg-clip-text text-transparent">
                        Kenali Profesi Management
                    </h1>
                </div>  
            </div>

            <!-- Desktop Header -->
            <div class="hidden md:flex justify-between items-center">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-slate-navy to-cool-gray bg-clip-text text-transparent">
                    Kenali Profesi Management
                </h1>
            </div>

             <!-- Aksi Cepat -->
            <section class="mb-8">
                <h2 class="text-xl font-semibold mb-4 text-slate-700">Aksi Cepat</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                    <!-- Profesi -->
                    <a href="{{ url('/admin/profesi') }}" class="p-4 bg-white rounded-2xl shadow hover:shadow-lg border border-slate-200 flex flex-col items-center transition">
                        <i class="fas fa-briefcase text-2xl text-slate-navy mb-2"></i>
                        <span class="text-slate-700 font-medium">Profesi</span>
                    </a>
                    <!-- Kategori -->
                    <a href="{{ url('/admin/kategori') }}" class="p-4 bg-white rounded-2xl shadow hover:shadow-lg border border-slate-200 flex flex-col items-center transition">
                        <i class="fas fa-layer-group text-2xl text-slate-navy mb-2"></i>
                        <span class="text-slate-700 font-medium">Kategori</span>
                    </a>
                    <!-- Tes -->
                    <a href="{{ url('/admin/tes') }}" class="p-4 bg-white rounded-2xl shadow hover:shadow-lg border border-slate-200 flex flex-col items-center transition">
                        <i class="fas fa-clipboard-check text-2xl text-slate-navy mb-2"></i>
                        <span class="text-slate-700 font-medium">Tes</span>
                    </a>
                    <!-- Soal -->
                    <a href="{{ url('/admin/soal') }}" class="p-4 bg-white rounded-2xl shadow hover:shadow-lg border border-slate-200 flex flex-col items-center transition">
                        <i class="fas fa-file-alt text-2xl text-slate-navy mb-2"></i>
                        <span class="text-slate-700 font-medium">Soal</span>
                    </a>
                    <!-- Jawaban -->
                    <a href="{{ url('/admin/jawaban') }}" class="p-4 bg-white rounded-2xl shadow hover:shadow-lg border border-slate-200 flex flex-col items-center transition">
                        <i class="fas fa-comments text-2xl text-slate-navy mb-2"></i>
                        <span class="text-slate-700 font-medium">Jawaban</span>
                    </a>
                </div>
            </section>
        </div>
    </main>
@endsection
