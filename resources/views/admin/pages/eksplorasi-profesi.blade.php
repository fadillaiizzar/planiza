@extends('layouts.admin')

@section('title', 'Eksplorasi Profesi Admin - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <div class="mx-auto max-w-7xl space-y-6">
            @include('admin.components.header.header', [
                'pageTitle' => 'Eksplorasi Profesi Management',
                'userCount' => $userCount,
            ])

            <!-- Aksi Cepat -->
            <section>
                <h2 class="text-xl font-semibold text-slate-navy mb-4">🚀 Aksi Cepat</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-5">
                    @php
                        $actions = [
                            ['route' => route('admin.eksplorasi-profesi.profesi-kerja.index'), 'icon' => 'fas fa-briefcase', 'label' => 'Profesi'],
                            ['route' => route('admin.eksplorasi-profesi.industri.index'), 'icon' => 'fas fa-industry', 'label' => 'Industri'],
                            ['route' => route('admin.eksplorasi-profesi.industri-profesi.index'), 'icon' => 'fas fa-project-diagram', 'label' => 'Industri Profesi'],
                        ];
                    @endphp

                    @foreach ($actions as $item)
                        <a href="{{ $item['route'] }}"
                           class="group p-5 bg-white rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 border border-slate-100 flex flex-col items-center text-center transition-all duration-300">
                            <div class="p-3 rounded-full bg-gradient-to-br from-indigo-100 to-blue-100 mb-3 group-hover:scale-110 transition">
                                <i class="{{ $item['icon'] }} text-slate-navy text-xl"></i>
                            </div>
                            <span class="text-slate-700 font-medium">{{ $item['label'] }}</span>
                        </a>
                    @endforeach

                </div>
            </section>

            <!-- Aktivitas -->
            <section>
                <h2 class="text-xl font-semibold text-slate-800 mb-4">📌 Aktivitas Terbaru</h2>
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-5">
                    <ul class="space-y-3">
                        @forelse($activities as $activity)
                            @php
                                $detailUrl = '#';

                                switch ($activity['type']) {
                                    case 'profesi':
                                        $detailUrl = route('admin.eksplorasi-profesi.profesi-kerja.show', $activity['id']);
                                        break;
                                    case 'industri':
                                        $detailUrl = route('admin.eksplorasi-profesi.industri.show', $activity['id']);
                                        break;
                                    case 'industri-profesi':
                                        $detailUrl = route('admin.eksplorasi-profesi.industri-profesi.show', $activity['id']);
                                        break;
                                }
                            @endphp

                            <li class="flex items-center justify-between gap-3 p-3 rounded-xl border border-slate-100 hover:bg-slate-50 transition">
                                <div class="flex items-center gap-3">
                                    @if($activity['action'] === 'create')
                                        <span class="p-2 rounded-full bg-green-100 text-green-600">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    @elseif($activity['action'] === 'update')
                                        <span class="p-2 rounded-full bg-blue-100 text-blue-600">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                    @elseif($activity['action'] === 'delete')
                                        <span class="p-2 rounded-full bg-red-100 text-red-600">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    @else
                                        <span class="p-2 rounded-full bg-slate-100 text-slate-500">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    @endif

                                    <div class="flex flex-col">
                                        <span class="text-slate-700">
                                            <b>{{ $activity['name'] }}</b> pada <span class="capitalize">{{ $activity['type'] }}</span>
                                            @if($activity['action'] === 'create')
                                                berhasil dibuat ✨
                                            @elseif($activity['action'] === 'update')
                                                diperbarui 🔄
                                            @elseif($activity['action'] === 'delete')
                                                dihapus ❌
                                            @else
                                                dicatat ⏳
                                            @endif
                                        </span>
                                        <span class="text-xs text-slate-500">{{ $activity['created_at']->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <a href="{{ $detailUrl }}" class="text-xs px-3 py-1 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 transition">
                                    Detail
                                </a>
                            </li>
                        @empty
                            <x-admin.empty-state/>
                        @endforelse
                    </ul>
                </div>
            </section>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
