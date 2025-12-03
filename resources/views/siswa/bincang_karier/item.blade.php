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
