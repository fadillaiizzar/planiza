<div class="bg-white border border-border-gray rounded-2xl shadow-sm mb-6 overflow-hidden">
    {{-- Question Header --}}
    <div class="bg-gradient-to-br from-off-white to-white p-6 border-b border-border-gray">
        <div class="flex items-start gap-4">
            {{-- Avatar --}}
            <div class="w-12 h-12 rounded-xl bg-slate-navy/10 flex items-center justify-center text-slate-navy flex-shrink-0">
                <i class="fas fa-user text-lg"></i>
            </div>

            {{-- User Info & Content --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h2 class="text-base font-bold text-slate-navy mb-1">
                            {{ $bincangKarier->user->name }}
                        </h2>
                        <div class="flex flex-col sm:flex-row items-start gap-1 sm:gap-3 text-xs text-cool-gray">
                            <span class="flex items-center gap-1.5">
                                <i class="fas fa-clock"></i>
                                {{ $bincangKarier->created_at->format('d M Y, H:i') }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i class="fas fa-comments"></i>
                                {{ $bincangKarier->tanggapanKarier->count() }} Tanggapan
                            </span>
                        </div>
                    </div>

                    {{-- Status Badge --}}
                    @if($bincangKarier->tanggapanKarier->count() > 0)
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
            </div>
        </div>
    </div>

    {{-- Question Body --}}
    <div class="px-6 py-4">
        <div class="text-slate-navy leading-relaxed text-[15px]">
            {!! nl2br(e($bincangKarier->isi_pertanyaan)) !!}
        </div>
    </div>
</div>
