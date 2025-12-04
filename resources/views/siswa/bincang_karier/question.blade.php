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
                {{ $bincangKarier->created_at->format('d M Y H:i') }}
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
