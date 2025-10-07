@extends('layouts.admin')

@section('title', 'Detail Attempt - Planiza')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-off-white via-white to-off-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button with Glassmorphism Effect -->
        <a href="{{ route('admin.kenali-profesi.hasil-tes.index') }}"
           class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-white/80 backdrop-blur-sm border border-border-gray/50 text-cool-gray hover:text-slate-navy hover:border-slate-navy/30 transition-all duration-300 mb-8 group shadow-sm hover:shadow-md">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="font-semibold text-sm">Kembali</span>
        </a>

        <!-- Header Section with Gradient Border -->
        <div class="relative bg-white rounded-2xl p-8 mb-8 overflow-hidden shadow-lg border border-border-gray/30">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-slate-navy via-cool-gray to-slate-navy"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-navy to-cool-gray flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-lg">{{ $attempt }}</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-navy tracking-tight">
                            Detail Attempt
                        </h1>
                    </div>
                </div>
                <div class="ml-15 space-y-1">
                    <p class="text-slate-navy font-medium">{{ $user->name }}</p>
                    <p class="text-cool-gray text-sm">{{ $tes->nama_tes }}</p>
                </div>
            </div>
        </div>

        <!-- Jawaban Section with Modern Card Design -->
        <div class="bg-white rounded-2xl overflow-hidden mb-8 shadow-lg border border-border-gray/30">
            <div class="px-6 py-5 bg-gradient-to-r from-slate-navy to-cool-gray">
                <h2 class="text-lg font-bold text-white tracking-wide">Daftar Jawaban</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-off-white border-b-2 border-slate-navy/10">
                            <th class="px-6 py-4 text-left text-slate-navy">No</th>
                            <th class="px-6 py-4 text-left text-slate-navy">Pertanyaan</th>
                            <th class="px-6 py-4 text-left text-slate-navy">Jawaban</th>
                            <th class="px-6 py-4 text-left text-slate-navy">Poin</th>
                            <th class="px-6 py-4 text-left text-slate-navy">Profesi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-gray/50">
                        @php $no = 1; @endphp
                        @forelse ($jawaban as $soal)
                            @foreach ($soal['jawaban'] as $idx => $jwb)
                                <tr class="group hover:bg-gradient-to-r hover:from-off-white hover:to-white transition-all duration-200">
                                    @if ($idx == 0)
                                        <td rowspan="{{ count($soal['jawaban']) }}" class="px-6 py-4 align-top">
                                            <div class="w-8 h-8 rounded-lg  flex items-center justify-center">
                                                <span class="text-sm font-bold text-slate-navy">{{ $no++ }}</span>
                                            </div>
                                        </td>
                                        <td rowspan="{{ count($soal['jawaban']) }}" class="px-6 py-4 text-sm text-slate-navy font-medium align-top max-w-md">
                                            {{ $soal['pertanyaan'] }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 text-sm text-cool-gray">{{ $jwb['isi_opsi'] }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center justify-center min-w-[2.5rem] px-3 py-1.5 rounded-lg bg-gradient-to-r from-slate-navy to-cool-gray text-white text-xs font-bold shadow-sm">
                                            {{ $jwb['poin'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-navy font-medium">{{ $jwb['profesi_tujuan'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-full bg-off-white flex items-center justify-center">
                                            <svg class="w-8 h-8 text-cool-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                        </div>
                                        <p class="text-cool-gray font-medium">Belum ada jawaban</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Rekap Poin Section with Grid Layout -->
        <div class="bg-white rounded-2xl overflow-hidden mb-8 shadow-lg border border-border-gray/30">
            <div class="px-6 py-5 border-b border-border-gray/30 bg-gradient-to-br from-off-white to-white">
                <h2 class="text-lg font-bold text-slate-navy">Rekap Total Poin per Profesi</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                    @foreach ($poinProfesi as $i => $profesi)
                    <div class="group flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-off-white to-white border border-border-gray/50 hover:border-slate-navy/30 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center gap-4 flex-1">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-navy/5 flex items-center justify-center group-hover:bg-slate-navy/10 transition-colors duration-300">
                                <span class="text-sm font-bold text-slate-navy">{{ $i + 1 }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-navy truncate">{{ $profesi->nama_profesi_kerja }}</p>
                            </div>
                        </div>
                        <div class="flex-shrink-0 ml-4">
                            <div class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-slate-navy to-cool-gray shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                <span class="text-white font-bold text-lg">{{ $profesi->total_poin }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Rekomendasi Teratas Section with Premium Cards -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-border-gray/30">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-navy to-cool-gray flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-slate-navy">Rekomendasi Teratas</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($topProfesi as $index => $profesi)
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-slate-navy to-cool-gray rounded-2xl opacity-0 group-hover:opacity-20 blur-xl transition-opacity duration-500"></div>
                    <div class="relative bg-white rounded-2xl border-2 border-border-gray group-hover:border-slate-navy p-6 transition-all duration-500 group-hover:scale-[1.02]">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="inline-flex items-center gap-2 py-1 rounded-full bg-off-white">
                                    <span class="text-lg font-bold text-slate-navy">#{{ $index + 1 }}</span>
                                </div>
                                <h3 class="font-bold text-slate-navy text-base leading-snug">
                                    {{ $profesi->nama_profesi_kerja }}
                                </h3>
                            </div>
                        </div>
                        <div class="flex items-end justify-between pt-4 border-t border-border-gray/50">
                            <div>
                                <p class="text-xs text-cool-gray mb-1 uppercase tracking-wide font-semibold">Total Poin</p>
                                <p class="text-3xl font-bold text-slate-navy">{{ $profesi->total_poin }}</p>
                            </div>
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-slate-navy to-cool-gray flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
