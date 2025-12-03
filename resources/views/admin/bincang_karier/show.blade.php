@extends('layouts.admin')

@section('title', 'Detail Bincang Karier')

@section('content')
<div class="px-4 py-8 sm:px-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Detail Bincang Karier</h1>
            <p class="text-sm text-gray-500">Lihat pertanyaan dan tanggapan siswa serta admin.</p>
        </div>
        <a href="{{ route('admin.bincang-karier.index') }}"
           class="text-sm bg-slate-100 px-4 py-2 rounded-lg hover:bg-slate-200 transition">
            Kembali
        </a>
    </div>

    {{-- Pertanyaan --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow mb-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                <i class="fas fa-question text-lg"></i>
            </div>
            <div class="flex-1">
                <p class="font-semibold text-slate-900">{{ $bincangKarier->user->name }}</p>
                <p class="text-gray-400 text-sm mb-2">{{ $bincangKarier->created_at->format('d M Y H:i') }}</p>
                <p class="text-slate-700 leading-relaxed">{{ $bincangKarier->isi_pertanyaan }}</p>
            </div>
        </div>
    </div>

    {{-- Tanggapan --}}
    <div class="max-h-[500px] overflow-y-auto space-y-4">
        @foreach($tanggapanKarier as $tanggapan)
            <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-slate-800">{{ $tanggapan->user->name }}</p>
                        <p class="text-xs text-gray-400 mb-2">{{ $tanggapan->created_at->diffForHumans() }}</p>
                        <div class="text-slate-700 leading-relaxed text-[15px]">
                            {!! nl2br(e($tanggapan->isi_tanggapan)) !!}
                        </div>

                        {{-- Aksi --}}
                        <div class="flex items-center gap-3 mt-3">
                            @if(Auth::id() === $tanggapan->user_id)
                                <button onclick="openModal('modalEditTanggapan-{{ $tanggapan->id }}')"
                                        class="text-blue-600 hover:text-blue-700 text-sm flex items-center gap-1">
                                    <i class="fas fa-edit text-xs"></i> Edit
                                </button>
                            @endif
                            <button onclick="openModal('modalDeleteTanggapan-{{ $tanggapan->id }}')"
                                    class="text-red-600 hover:text-red-700 text-sm flex items-center gap-1">
                                <i class="fas fa-trash text-xs"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Edit --}}
            @include('admin.bincang_karier.tanggapan_karier.edit', ['tanggapan' => $tanggapan])

            {{-- Modal Delete --}}
            @include('admin.bincang_karier.tanggapan_karier.delete', ['tanggapan' => $tanggapan])
        @endforeach
    </div>

    {{-- Form Tanggapan Admin --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-800 mb-3">Tambah Tanggapan</h3>

        <form action="{{ route('admin.tanggapan-karier.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="hidden" name="bincang_karier_id" value="{{ $bincangKarier->id }}">
            <textarea name="isi_tanggapan" rows="4" required
                      class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-slate-300 focus:outline-none"
                      placeholder="Tulis tanggapan admin...">{{ old('isi_tanggapan') }}</textarea>
            @error('isi_tanggapan')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
            <button type="submit"
                    class="mt-2 bg-slate-navy text-white px-5 py-2 rounded-xl text-sm font-semibold hover:shadow-lg transition flex items-center gap-2">
                <i class="fas fa-paper-plane text-xs"></i>
                Kirim Tanggapan
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
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
