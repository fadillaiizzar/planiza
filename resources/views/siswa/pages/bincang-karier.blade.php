@extends('layouts.siswa')

@section('title', 'Bincang Karier - Siswa')

@section('content')

<div id="main-content" class="px-4 py-8 sm:px-8">

    {{-- Header Section --}}
    <x-siswa.section-header
        title="Bincang Karier"
        subtitle="Ajukan pertanyaan seputar pilihan karier, jurusan kuliah, dan masa depanmu. Konselor siap membantu menjelaskan jawaban terbaik untuk kamu."
        back-route="siswa.dashboard"
    />

    {{-- Action Bar : Search + Create Button --}}
    <div class="flex flex-col sm:flex-row gap-3 mb-6 items-stretch sm:items-center">
        {{-- Search Bar --}}
        <div class="flex-1 relative">
            <input
                type="text"
                id="search"
                placeholder="Cari pertanyaan berdasarkan kata kunci..."
                class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-border-gray focus:outline-none focus:ring-2 focus:ring-slate-navy focus:border-transparent text-sm transition-all"
            />
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-cool-gray text-sm"></i>
        </div>

        {{-- Create Button --}}
        <button onclick="openCreateBincang()"
            class="bg-slate-navy text-white px-6 py-2.5 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 text-sm font-semibold flex items-center justify-center gap-2 hover:bg-opacity-90 whitespace-nowrap">
            <i class="fas fa-plus"></i>
            <span>Buat Pertanyaan</span>
        </button>
    </div>

    {{-- Stats Summary --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 border border-border-gray">
            <p class="text-xs text-cool-gray mb-1">Total Pertanyaan</p>
            <p class="text-2xl font-bold text-slate-navy">{{ $bincangKarier->total() }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-border-gray">
            <p class="text-xs text-cool-gray mb-1">Pertanyaanku</p>
            <p class="text-2xl font-bold text-slate-navy">{{ $bincangKarier->where('user_id', Auth::id())->count() }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-border-gray">
            <p class="text-xs text-cool-gray mb-1">Sudah Dijawab</p>
            <p class="text-2xl font-bold text-green-600">{{ $bincangKarier->where('tanggapanKarier', '>', 0)->count() }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-border-gray">
            <p class="text-xs text-cool-gray mb-1">Menunggu Jawaban</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $bincangKarier->where('tanggapanKarier', 0)->count() }}</p>
        </div>
    </div>

{{-- Card List with Enhanced Design --}}
    <div class="grid grid-cols-1 gap-5">
        @forelse($bincangKarier as $item)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 border border-border-gray overflow-hidden group">

                {{-- Card Header --}}
                <div class="p-5 pb-4 border-b border-border-gray bg-gradient-to-br from-off-white to-white">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base font-semibold text-slate-navy leading-snug flex-1 group-hover:text-blue-600 transition-colors line-clamp-2 md:line-clamp-1">
                            {{ $item->isi_pertanyaan }}
                        </h3>

                        {{-- Status Badge --}}
                        @if($item->tanggapanKarier->count() > 0)
                            <span class="px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-semibold border border-green-200 flex items-center gap-1.5 whitespace-nowrap">
                                <i class="fas fa-check-circle"></i>
                                Terjawab
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-semibold border border-yellow-200 flex items-center gap-1.5 whitespace-nowrap">
                                <i class="fas fa-clock"></i>
                                Menunggu
                            </span>
                        @endif
                    </div>

                    {{-- Meta Info --}}
                    <div class="flex items-center gap-2 sm:gap-4 text-xs text-cool-gray">
                        <div class="flex items-center gap-1.5">
                            <i class="fas fa-user-circle"></i>
                            <span>{{ $item->user->name }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <i class="fas fa-clock"></i>
                            <span>{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <i class="fas fa-comments"></i>
                            <span>{{ $item->tanggapanKarier->count() }}</span>
                            <span>Tanggapan</span>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="p-5 pt-4">
                    <div class="flex items-center justify-start gap-2">
                        <a href="{{ route('siswa.bincang-karier.show', $item->id) }}"
                            class="bg-slate-navy text-white px-10 py-2 rounded-lg bg-opacity-80 hover:bg-opacity-100 font-medium text-sm flex items-center justify-center gap-2 transition-all duration-200 shadow-sm hover:shadow">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>

                        {{-- Edit/Delete hanya untuk pemilik --}}
                        @if($item->user_id == Auth::id())
                            <button onclick="openEditBincang({{ $item->id }}, `{{ addslashes($item->isi_pertanyaan) }}`)"
                                class="w-10 h-10 rounded-lg border border-border-gray text-slate-navy hover:bg-off-white flex items-center justify-center transition-all duration-200"
                                title="Edit Pertanyaan">
                                <i class="fas fa-edit text-sm"></i>
                            </button>

                            <button type="button"
                                    onclick="openDeleteBincang({{ $item->id }}, '{{ Str::limit(addslashes($item->isi_pertanyaan), 40) }}')"
                                    class="w-10 h-10 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 flex items-center justify-center transition-all duration-200"
                                    title="Hapus Pertanyaan">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-2xl border-2 border-dashed border-border-gray p-12 text-center">
                    <div class="w-20 h-20 bg-off-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-comments text-3xl text-cool-gray"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-navy mb-2">Belum Ada Pertanyaan</h3>
                    <p class="text-sm text-cool-gray mb-6 max-w-md mx-auto">
                        Ayo mulai dengan mengajukan pertanyaan seputar pilihan karier, jurusan kuliah, atau masa depanmu!
                    </p>
                    <button onclick="openCreateBincang()"
                        class="bg-slate-navy text-white px-6 py-2.5 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 text-sm font-semibold inline-flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        Buat Pertanyaan Pertama
                    </button>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $bincangKarier->links() }}
        <x-paginate :items="$bincangKarier" />
    </div>
</div>

<div id="modalCreateBincang" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    @include('siswa.bincang_karier.create')
</div>

<div id="modalEditBincang" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    @include('siswa.bincang_karier.edit')
</div>

<div id="modalDeleteBincang" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    @include('siswa.bincang_karier.delete')
</div>

@endsection

@push('scripts')
    <script>
        // ========== SEARCH FUNCTIONALITY ==========
        document.getElementById('search').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.grid > div:not(.col-span-full)');

            cards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // ========== CREATE ==========
        function openCreateBincang() {
            document.getElementById('modalCreateBincang').classList.remove('hidden');
            document.getElementById('modalCreateBincang').classList.add('flex');
        }

        function closeCreateBincang() {
            document.getElementById('modalCreateBincang').classList.add('hidden');
            document.getElementById('modalCreateBincang').classList.remove('flex');
        }

        // ========== EDIT ==========
        function openEditBincang(id, isi) {
            // Set action form update
            document.getElementById('formEditBincang').action = `/siswa/bincang-karier/${id}`;
            // Set textarea value
            document.getElementById('editIsiPertanyaan').value = isi;

            document.getElementById('modalEditBincang').classList.remove('hidden');
            document.getElementById('modalEditBincang').classList.add('flex');
        }

        function closeEditBincang() {
            document.getElementById('modalEditBincang').classList.add('hidden');
            document.getElementById('modalEditBincang').classList.remove('flex');
        }

        // ========== DELETE ==========
        function openDeleteBincang(id, text) {
            document.getElementById('modalDeleteBincang').classList.remove('hidden');
            document.getElementById('modalDeleteBincang').classList.add('flex');
            document.getElementById('deleteBincangText').textContent = '"' + text + '"';

            const form = document.getElementById('deleteBincangForm');
            form.action = `/siswa/bincang-karier/${id}`;
        }

        function closeDeleteBincang() {
            document.getElementById('modalDeleteBincang').classList.add('hidden');
        }
    </script>
@endpush
