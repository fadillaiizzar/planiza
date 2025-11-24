@extends('layouts.admin')

@section('title', 'Manajemen SDGs - Planiza')

@section('content')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-green-50 to-emerald-50 p-4 md:p-6">
        <div class="mx-auto max-w-7xl space-y-6">

            {{-- Header --}}
            @include('admin.components.header.header', [
                'pageTitle' => 'Manajemen SDGs',
                'userCount' => $userCount,
            ])

            {{-- Aksi Cepat --}}
            <section>
                <h2 class="text-xl font-semibold text-slate-navy mb-4">🌱 Aksi Cepat</h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-5">
                    @php
                        $actions = [
                            ['route' => route('admin.sdgs.kategori-sdgs.index'), 'icon' => 'fas fa-layer-group', 'label' => 'Kategori SDGs'],
                            // kalau nanti ada resource lain aktifkan baris berikut:
                            ['route' => route('admin.sdgs.kontribusi-sdgs.index'), 'icon' => 'fas fa-hands-helping', 'label' => 'Kontribusi SDGs'],
                            ['route' => route('admin.sdgs.hubungan-sdgs.index'), 'icon' => 'fas fa-link', 'label' => 'Hubungan SDGs'],
                        ];
                    @endphp

                    @foreach ($actions as $item)
                        <a href="{{ $item['route'] }}"
                           class="group p-5 bg-white rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 border border-slate-100 flex flex-col items-center text-center transition-all duration-300">
                            <div class="p-3 rounded-full bg-gradient-to-br from-emerald-100 to-green-100 mb-3 group-hover:scale-110 transition">
                                <i class="{{ $item['icon'] }} text-slate-navy text-xl"></i>
                            </div>
                            <span class="text-slate-700 font-medium">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </section>

            {{-- Aktivitas Terbaru --}}
            <section>
                <h2 class="text-xl font-semibold text-slate-800 mb-4">📌 Aktivitas Terbaru</h2>
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-5">
                    <ul class="space-y-3">
                        @forelse($activities as $activity)
                            @php
                                // default ke '#'
                                $detailUrl = '#';

                                // mapping ke route berdasarkan type (sesuaikan nama route bila beda)
                                switch ($activity['type']) {
                                    case 'Kategori SDGs':
                                        // resource: admin.sdgs.kategori-sdgs.show
                                        $detailUrl = route('admin.sdgs.kategori-sdgs.show', $activity['id'] ?? 0);
                                        break;

                                    case 'Kontribusi SDGs':
                                        // jika sudah ada resource, aktifkan:
                                        $detailUrl = route('admin.sdgs.kontribusi-sdgs.show', $activity['id'] ?? 0);
                                        break;

                                    case 'Hubungan SDGs':
                                        // jika sudah ada resource, aktifkan:
                                        // $detailUrl = route('admin.sdgs.hubungan.show', $activity['id']);
                                        $detailUrl = route('admin.sdgs.kategori-sdgs.show', $activity['id'] ?? 0); // fallback
                                        break;

                                    // contoh lain: jika aktivitas berasal dari submission/attempt siswa, bisa diarahkan beda
                                    case 'Hasil Form Siswa':
                                        if (!empty($activity['user_id']) && !empty($activity['id'])) {
                                            $detailUrl = route('admin.kenali-jurusan.hasil-form.user-attempt', [
                                                'user_id' => $activity['user_id'],
                                                'form_id' => $activity['id'],
                                            ]);
                                        }
                                        break;

                                    default:
                                        $detailUrl = '#';
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
                                    @elseif($activity['action'] === 'submit')
                                        <span class="p-2 rounded-full bg-emerald-100 text-emerald-600">
                                            <i class="fas fa-paper-plane"></i>
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
                                                berhasil diperbarui 🔄
                                            @elseif($activity['action'] === 'submit')
                                                berhasil disubmit{{ !empty($activity['attempt']) ? ' ke-'.$activity['attempt'] : '' }} ✨
                                            @else
                                                dicatat ⏳
                                            @endif
                                        </span>
                                        <span class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}</span>
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
