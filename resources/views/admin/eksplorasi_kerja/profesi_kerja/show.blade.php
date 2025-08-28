@extends('layouts.admin')

@section('title', 'Detail Profesi Kerja - Planiza')

@section('content')
<main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6 md:p-8">
    <div class="mb-8 max-w-4xl mx-auto">

        <!-- Breadcrumb Guide -->
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('admin.eksplorasi-profesi.profesi-kerja.index') }}"
               class="group flex items-center px-4 py-2 rounded-full text-slate-400 hover:text-slate-600 hover:bg-white/70 transition-all duration-200">
                <i class="fas fa-briefcase w-4 h-4 mr-2 text-slate-300 group-hover:text-slate-500"></i>
                <span class="font-medium">Profesi Kerja</span>
            </a>

            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>

            <div class="flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-slate-600 to-slate-700 text-white shadow-md">
                <i class="fas fa-info-circle w-4 h-4 mr-2"></i>
                <span class="font-semibold">Detail Profesi</span>
            </div>
        </nav>
    </div>

    <!-- Card Detail -->
    <div class="w-full max-w-4xl mx-auto text-left bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-slate-600 to-slate-700 px-8 py-6">
            <div class="flex items-center space-x-3 text-left justify-start">
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-briefcase text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Detail Profesi Kerja</h2>
                    <p class="text-slate-200 text-sm">Informasi lengkap profesi kerja</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-8 pt-8 pb-0 space-y-5">
            <!-- ID -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-hashtag mr-2 text-slate-500"></i> ID Profesi
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    {{ $profesi->id }}
                </div>
            </div>

            <!-- Nama Profesi -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-briefcase mr-2 text-blue-500"></i> Nama Profesi
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    {{ $profesi->nama_profesi_kerja }}
                </div>
            </div>

            <!-- Gaji -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-dollar-sign mr-2 text-green-500"></i> Gaji
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    Rp {{ number_format($profesi->gaji, 0, ',', '.') }}
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-align-left mr-2 text-purple-500"></i> Deskripsi
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    {{ $profesi->deskripsi }}
                </div>
            </div>

            <!-- Info Skill -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-lightbulb mr-2 text-yellow-500"></i> Info Skill
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    {{ $profesi->info_skill }}
                </div>
            </div>

            <!-- Info Jurusan -->
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-school mr-2 text-orange-500"></i> Info Jurusan
                </label>
                <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm">
                    {{ $profesi->info_jurusan }}
                </div>
            </div>

            <!-- Gambar -->
            @if($profesi->gambar)
            <div class="group">
                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-image mr-2 text-pink-500"></i> Gambar
                </label>
                <img src="{{ asset('storage/'.$profesi->gambar) }}" alt="{{ $profesi->nama_profesi_kerja }}" class="rounded-2xl w-full max-w-md shadow-sm">
            </div>
            @endif
        </div>

        <!-- Footer Actions -->
        <div class="px-8 py-5 bg-slate-50 border-t border-slate-100">
            <div class="flex items-center justify-between text-left">
                <div class="text-xs text-slate-500">
                    <span class="flex items-center">
                        <i class="fas fa-clock w-3 h-3 mr-1"></i>
                        Terakhir diperbarui: {{ $profesi->updated_at->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/app.js') }}"></script>
@endpush
