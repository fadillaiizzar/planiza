@extends('layouts.siswa')

@section('title', 'Materi')

@section('content')
<div class="min-h-screen bg-off-white">
    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">

        <x-siswa.section-header
            title="Temukan Materi"
            subtitle="Semua materi belajar yang kamu butuhkan, tersusun rapi berdasarkan kelas, jurusan, dan rencana"
            back-route="siswa.dashboard"
        />

        <x-siswa.info-siswa :siswa="$siswa" />

        {{-- Search Bar dengan Design Modern --}}
        <div class="mb-8">
            <div class="relative max-w-2xl mx-auto">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                    <i class="fas fa-search text-cool-gray text-lg"></i>
                </div>
                <input type="text"
                       id="search"
                       placeholder="Cari topik favoritmu..."
                       class="w-full pl-14 pr-6 py-4 bg-white border-2 border-border-gray rounded-3xl shadow-lg focus:outline-none focus:border-slate-navy focus:ring-4 focus:ring-slate-navy/10 transition-all duration-300 text-slate-navy placeholder-cool-gray">
            </div>
        </div>

        {{-- Grid Topik Materi --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($topikMateris as $item)
                @php
                    $slug = strtolower(str_replace(' ', '-', $item->judul_topik));
                    $icons = ['fa-book', 'fa-lightbulb', 'fa-pencil-alt', 'fa-graduation-cap', 'fa-flask'];
                    $materiCount = $item->materis->count() ?? 0;
                @endphp

                <div class="group relative bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-border-gray hover:border-slate-navy/20 hover:-translate-y-1">

                    {{-- Decorative Background --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-slate-navy/5 rounded-full -mr-16 -mt-16 group-hover:bg-slate-navy/10 transition-colors duration-500"></div>

                    {{-- Card Content --}}
                    <div class="relative z-10 p-6 flex flex-col items-center text-center h-full">

                        {{-- Icon Container --}}
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-slate-navy to-slate-navy/80 flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                            <i class="fas fa-book-open text-off-white text-2xl"></i>
                        </div>

                        {{-- Judul Topik --}}
                        <h2 class="text-lg font-bold mb-3 line-clamp-2 text-slate-navy min-h-14 group-hover:text-slate-navy/90 transition-colors">
                            {{ $item->judul_topik }}
                        </h2>

                        {{-- Badge Jumlah Materi --}}
                        <div class="inline-flex items-center gap-2 bg-slate-navy/10 text-slate-navy font-semibold text-sm px-4 py-2 rounded-full mb-4 group-hover:bg-slate-navy group-hover:text-off-white transition-all duration-300">
                            <i class="fas fa-layer-group text-xs"></i>
                            <span>{{ $materiCount }} Materi</span>
                        </div>

                        {{-- Spacer --}}
                        <div class="flex-grow"></div>

                        {{-- Toggle Button --}}
                        <button onclick="toggleMateri('{{ $slug }}', this)"
                                class="mt-4 inline-flex items-center gap-2 text-slate-navy font-semibold hover:text-cool-gray transition-colors group/btn">
                            <span>Lihat Materi</span>
                            <i class="fas fa-chevron-down transition-transform duration-300 group-hover/btn:translate-y-0.5"></i>
                        </button>

                        {{-- Daftar Materi (Hidden by default) --}}
                        <div id="{{ $slug }}"
                             class="hidden mt-5 w-full bg-gradient-to-br from-slate-navy/5 to-cool-gray/5 rounded-2xl p-4 border border-border-gray animate-fadeIn">
                            @if($materiCount > 0)
                                <div class="max-h-56 overflow-y-auto space-y-2 pr-2 custom-scrollbar">
                                    @foreach($item->materis ?? [] as $index => $sub)
                                        @php
                                            $icon = $icons[$index % count($icons)];
                                        @endphp
                                        <a href="{{ route('siswa.materi.show', $sub->id) }}"
                                           class="group/item flex items-start gap-3 p-3 bg-white rounded-xl hover:bg-slate-navy hover:shadow-md transition-all duration-300 border border-transparent hover:border-slate-navy">
                                            <div class="w-8 h-8 rounded-lg bg-slate-navy/10 flex items-center justify-center flex-shrink-0 group-hover/item:bg-off-white transition-colors">
                                                <i class="fas {{ $icon }} text-slate-navy text-sm group-hover/item:text-slate-navy"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-slate-navy group-hover/item:text-off-white transition-colors line-clamp-2">
                                                    {{ $sub->nama_materi }}
                                                </p>
                                            </div>
                                            <i class="fas fa-arrow-right text-cool-gray text-xs mt-1 opacity-0 group-hover/item:opacity-100 group-hover/item:text-off-white transition-all duration-300 group-hover/item:translate-x-1"></i>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-6">
                                    <div class="w-12 h-12 rounded-full bg-slate-navy/10 flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-inbox text-cool-gray text-xl"></i>
                                    </div>
                                    <p class="text-sm text-cool-gray font-medium">Belum ada materi tersedia</p>
                                    <p class="text-xs text-cool-gray/70 mt-1">Materi akan segera ditambahkan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-3xl shadow-xl p-12 text-center border-2 border-dashed border-border-gray">
                        <div class="w-24 h-24 rounded-full bg-slate-navy/5 flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-book-open text-5xl text-cool-gray/30"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-navy mb-3">Belum Ada Topik Tersedia</h3>
                        <p class="text-cool-gray max-w-md mx-auto mb-6">
                            Tenang aja, materi akan segera ditambahkan. Sementara itu, kamu bisa eksplorasi bagian lain dulu
                        </p>
                        <div class="flex flex-wrap gap-3 justify-center">
                            <span class="inline-flex items-center gap-2 bg-slate-navy/10 text-slate-navy px-4 py-2 rounded-full text-sm font-medium">
                                <i class="fas fa-clock"></i>
                                Segera Hadir
                            </span>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #CBD5E1;
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #64748B;
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #1E293B;
}
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
}
</style>
@endpush

@push('scripts')
<script>
    // Search Functionality
    document.getElementById('search').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.group.relative.bg-white');

        cards.forEach(card => {
            const title = card.querySelector('h2').textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                card.style.display = '';
                card.classList.add('animate-fadeIn');
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Toggle Materi Function
    function toggleMateri(id, btn) {
        const el = document.getElementById(id);
        const icon = btn.querySelector('i');
        const isOpen = !el.classList.contains('hidden');

        // Close all other open materis
        document.querySelectorAll('[id]').forEach(element => {
            if (element.id && element.id !== id && !element.classList.contains('hidden')) {
                element.classList.add('hidden');
                // Reset icon for closed items
                const parentCard = element.closest('.group');
                if (parentCard) {
                    const otherBtn = parentCard.querySelector('button');
                    if (otherBtn) {
                        const otherIcon = otherBtn.querySelector('i');
                        if (otherIcon) {
                            otherIcon.classList.remove('fa-chevron-up', 'rotate-180');
                            otherIcon.classList.add('fa-chevron-down');
                        }
                    }
                }
            }
        });

        // Toggle current materi
        el.classList.toggle('hidden');

        // Update icon
        if (isOpen) {
            icon.classList.remove('fa-chevron-up', 'rotate-180');
            icon.classList.add('fa-chevron-down');
        } else {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up', 'rotate-180');
        }
    }
</script>
@endpush
