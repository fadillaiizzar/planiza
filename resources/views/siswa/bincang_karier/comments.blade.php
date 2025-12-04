<div class="bg-white border border-border-gray rounded-2xl shadow-sm overflow-hidden">
    {{-- Comments Header --}}
    <div class="bg-gradient-to-br from-off-white to-white px-6 py-4 border-b border-border-gray">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-navy flex items-center gap-2">
                <i class="fas fa-comments text-cool-gray"></i>
                Diskusi & Tanggapan
            </h3>
            <span class="px-3 py-1 rounded-full bg-slate-navy/10 text-slate-navy text-sm font-semibold">
                {{ $bincangKarier->tanggapanKarier->count() }}
            </span>
        </div>
    </div>

    {{-- Comments List --}}
    @php
        $total = $bincangKarier->tanggapanKarier->count();
    @endphp

    @if($total === 0)
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-off-white rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-comments text-2xl text-cool-gray"></i>
            </div>
            <p class="text-cool-gray text-sm italic">
                Belum ada tanggapan. Jadilah yang pertama membalas.
            </p>
        </div>
    @else
        <div class="divide-y divide-border-gray max-h-96 overflow-y-auto">
            @foreach($bincangKarier->tanggapanKarier->sortByDesc('created_at') as $tanggapan)
                <div class="p-6 hover:bg-off-white transition-colors">
                    <div class="flex items-start gap-4">
                        {{-- Avatar --}}
                        <div class="w-10 h-10 rounded-xl bg-cool-gray/10 flex items-center justify-center text-cool-gray flex-shrink-0">
                            <i class="fas fa-user text-sm"></i>
                        </div>

                        {{-- Comment Content --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <div>
                                    <p class="font-semibold text-slate-navy text-sm">
                                        {{ $tanggapan->user->name }}
                                    </p>
                                    <p class="text-xs text-cool-gray mt-0.5">
                                        {{ $tanggapan->created_at->diffForHumans() }}
                                    </p>
                                </div>

                                {{-- Owner Actions --}}
                                @if($tanggapan->user_id == Auth::id())
                                    <div class="flex items-center gap-1">
                                        <button onclick="openModal('modalEditTanggapan-{{ $tanggapan->id }}')"
                                            class="w-8 h-8 rounded-lg border border-border-gray text-cool-gray hover:text-slate-navy hover:bg-off-white flex items-center justify-center transition-all"
                                            title="Edit Tanggapan">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>

                                        <button onclick="openModal('modalDeleteTanggapan-{{ $tanggapan->id }}')"
                                            class="w-8 h-8 rounded-lg border border-red-200 text-red-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-all"
                                            title="Hapus Tanggapan">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div class="text-slate-navy leading-relaxed text-[15px] mt-3">
                                {!! nl2br(e($tanggapan->isi_tanggapan)) !!}
                            </div>
                        </div>
                    </div>

                    {{-- Include modals --}}
                    @include('siswa.bincang_karier.tanggapan_karier.edit')
                    @include('siswa.bincang_karier.tanggapan_karier.delete')
                </div>
            @endforeach
        </div>
    @endif
</div>
