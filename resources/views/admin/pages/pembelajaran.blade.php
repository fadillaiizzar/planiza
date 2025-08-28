@extends('layouts.admin')

@section('title', 'Pembelajaran Admin - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <div class="mx-auto max-w-7xl space-y-6">
            {{-- Header --}}
            @include('admin.components.header.header', [
                'pageTitle' => 'Pembelajaran Management',
                'userCount' => $userCount,
                'stats' => [
                    ['label' => 'Total Topik Materi', 'count' => $topikMateriCount, 'icon' => 'fas fa-layer-group', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                    ['label' => 'Total Materi', 'count' => $materiCount, 'icon' => 'fas fa-book-open', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                ],
            ])

            <!-- Aksi Cepat -->
            <section>
                <h2 class="text-xl font-semibold text-slate-navy mb-4">🚀 Aksi Cepat</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-5">

                    @php
                        $actions = [
                            ['route' => route('admin.pembelajaran.topik-materi.index'), 'icon' => 'fas fa-layer-group', 'label' => 'Topik Materi'],
                            ['route' => route('admin.pembelajaran.materi.index'), 'icon' => 'fas fa-book-open', 'label' => 'Materi'],
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
                                    case 'Topik Materi':
                                        $detailUrl = route('admin.pembelajaran.topik-materi.show', $activity['id']);
                                        break;
                                    case 'Materi':
                                        $detailUrl = route('admin.pembelajaran.materi.show', $activity['id']);
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
                            <li class="text-slate-500 text-center py-4">Belum ada aktivitas terbaru</li>
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
