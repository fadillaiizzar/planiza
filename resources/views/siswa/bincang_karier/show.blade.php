@extends('layouts.siswa')

@section('title', 'Detail Bincang Karier')

@section('content')

<div id="main-content" class="px-4 py-8 sm:px-8">

    {{-- Header Section --}}
    <x-siswa.section-header
        title="Detail Bincang Karier"
        subtitle="Lihat detail pertanyaan dan diskusi bersama konselor."
        back-route="siswa.bincang-karier.index"
    />

    {{-- Box Pertanyaan --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow p-6 mb-8">
        <div class="flex items-start gap-4">
            <div class="w-11 h-11 rounded-full bg-slate-200 flex items-center justify-center text-xl text-slate-600">
                <i class="fas fa-user"></i>
            </div>

            <div class="flex-1">
                <h2 class="text-lg font-semibold text-slate-800 mb-1">
                    {{ $bincangKarier->user->name }}
                </h2>
                <p class="text-gray-400 text-xs mb-4">
                    {{ $bincangKarier->created_at->diffForHumans() }}
                </p>

                <div class="text-slate-700 leading-relaxed text-[15px]">
                    {!! nl2br(e($bincangKarier->isi_pertanyaan)) !!}
                </div>
            </div>

            {{-- Status --}}
            <div>
                @if($bincangKarier->tanggapanKarier->count() > 0)
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                        Sudah Dijawab
                    </span>
                @else
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                        Belum Dijawab
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- Judul Komentar --}}
    <h3 class="text-lg font-semibold text-slate-800 mb-4">
        Diskusi & Tanggapan
        <span>
            — {{ $bincangKarier->tanggapanKarier->count() }}
        </span>
    </h3>

    {{-- Loop Tanggapan --}}
    @forelse($bincangKarier->tanggapanKarier as $tanggapan)
        <div class="bg-white border border-gray-100 rounded-xl p-5 mb-4 shadow-sm">
            <div class="flex items-start gap-3">

                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                    <i class="fas fa-user"></i>
                </div>

                <div class="flex-1">
                    <p class="font-semibold text-slate-800 text-sm">
                        {{ $tanggapan->user->name }}
                    </p>
                    <p class="text-xs text-gray-400 mb-2">
                        {{ $tanggapan->created_at->diffForHumans() }}
                    </p>

                    <div class="text-slate-700 leading-relaxed text-[15px]">
                        {!! nl2br(e($tanggapan->isi_tanggapan)) !!}
                    </div>

                    {{-- Aksi pemilik tanggapan --}}
                    @if($tanggapan->user_id == Auth::id())
                        <div class="flex items-center gap-3 mt-3">
                            <button onclick="openModal('modalEditTanggapan-{{ $tanggapan->id }}')"
                                class="text-blue-600 hover:text-blue-700 text-sm flex items-center gap-1">
                                <i class="fas fa-edit text-xs"></i> Edit
                            </button>

                            <button onclick="openModal('modalDeleteTanggapan-{{ $tanggapan->id }}')"
                                class="text-red-600 hover:text-red-700 text-sm flex items-center gap-1">
                                <i class="fas fa-trash text-xs"></i> Hapus
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @include('siswa.bincang_karier.tanggapan_karier.edit')
        @include('siswa.bincang_karier.tanggapan_karier.delete')
    @empty
        <p class="text-gray-500 text-sm italic">Belum ada tanggapan. Jadilah yang pertama membalas.</p>
    @endforelse

    {{-- Form Balas --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow p-6 mt-8">
        <h3 class="text-lg font-semibold text-slate-800 mb-3">Balas Pertanyaan</h3>

        <form action="{{ route('siswa.tanggapan-karier.store') }}" method="POST">
            @csrf

            <input type="hidden" name="bincang_karier_id" value="{{ $bincangKarier->id }}">

            <textarea name="isi_tanggapan"
                      rows="5"
                      required
                      class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-slate-300 focus:outline-none"
                      placeholder="Tulis tanggapanmu di sini...">{{ old('isi_tanggapan') }}</textarea>

            @error('isi_tanggapan')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror

            <button type="submit"
                class="mt-4 bg-slate-navy text-white px-5 py-2 rounded-xl text-sm font-semibold hover:shadow-lg transition flex items-center gap-2">
                <i class="fas fa-paper-plane text-xs"></i>
                Kirim Tanggapan
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }
    </script>
@endpush
