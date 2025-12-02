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

    {{-- Button + Search --}}
    <div class="flex flex-col sm:flex-row sm:justify-between gap-4 mb-6">
        <x-siswa.search-bar id="search" placeholder="Cari pertanyaan..." />

        <button onclick="openCreateBincang()"
            class="bg-slate-navy text-white px-4 py-2 rounded-xl shadow hover:shadow-lg transition text-sm font-semibold flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Buat Pertanyaan
        </button>
    </div>

    {{-- Card List --}}
    <div class="grid grid-cols-1 gap-6">
        @forelse($bincangKarier as $item)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition border border-gray-100 p-6">
                <div class="flex items-start justify-between">

                    {{-- Left --}}
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-slate-800 mb-2">
                            {{ Str::limit($item->isi_pertanyaan, 120) }}
                        </h3>

                        <p class="text-sm text-gray-500 flex items-center gap-2">
                            <i class="fas fa-user-circle"></i>
                            {{ $item->user->name }}
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            {{ $item->created_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- Icon / Status --}}
                    <div class="ml-4">
                        @if($item->tanggapanKarier->count() > 0)
                            <span
                                class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                Sudah Dijawab
                            </span>
                        @else
                            <span
                                class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                Belum Dijawab
                            </span>
                        @endif
                    </div>

                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3 mt-5">

                    <a href="{{ route('siswa.bincang-karier.show', $item->id) }}"
                        class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center gap-1">
                        Lihat Detail
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>

                    {{-- Edit/Delete hanya untuk pemilik --}}
                    @if($item->user_id == Auth::id())
                        <a href="{{ route('siswa.bincang-karier.edit', $item->id) }}"
                            class="text-slate-600 hover:text-slate-800 text-sm flex items-center gap-1">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>

                        <form action="{{ route('siswa.bincang-karier.destroy', $item->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus pertanyaan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-700 text-sm flex items-center gap-1">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        @empty
            <x-siswa.empty-state
                title="Belum Ada Pertanyaan"
                message="Ayo mulai dengan mengajukan pertanyaan seputar pilihan karier!"
            />
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $bincangKarier->links() }}
        <x-paginate :jurusans="$bincangKarier" />
    </div>
</div>

<div id="modalCreateBincang" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    @include('siswa.bincang_karier.create')
</div>

@endsection

@push('scripts')
    <script>
        function openCreateBincang() {
            document.getElementById('modalCreateBincang').classList.remove('hidden');
            document.getElementById('modalCreateBincang').classList.add('flex');
        }

        function closeCreateBincang() {
            document.getElementById('modalCreateBincang').classList.add('hidden');
            document.getElementById('modalCreateBincang').classList.remove('flex');
        }
    </script>
@endpush
