@php
    $minTop3Score = $allProfesi->take(3)->last()->total_poin ?? null;
    $tieProfesi = $allProfesi->filter(fn($p) => $p->total_poin == $minTop3Score && !$allProfesi->take(3)->contains($p));
    $extraCount = $tieProfesi->count();
    $tieScore = $extraCount > 0 ? $minTop3Score : null;
@endphp

<div id="topProfesiGrid" class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 mb-16 relative py-12">
    @foreach($topProfesi as $index => $profesi)
        @php
            $isHidden = $index >= 3 ? 'hidden tie-card' : '';
        @endphp

        <div class="group relative {{ $isHidden }} {{ $index === 0 ? 'lg:scale-105 lg:-translate-y-4' : '' }} transition-all duration-500 hover:scale-105 hover:-translate-y-2">
            <div class="absolute -top-4 -right-4 z-20 w-14 h-14 {{ $index === 0 ? 'bg-slate-navy' : 'bg-cool-gray' }} text-white rounded-full flex items-center justify-center font-bold text-xl shadow-lg border-4 border-white">
                #{{ $index + 1 }}
            </div>

            <div class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden border border-border-gray/20 h-full flex flex-col relative">
                <div class="relative h-48 bg-gradient-to-br from-slate-navy/5 to-cool-gray/10 flex items-center justify-center overflow-hidden">
                    <div class="absolute top-4 right-4 w-20 h-20 bg-slate-navy/5 rounded-full"></div>
                    <div class="absolute bottom-6 left-6 w-16 h-16 bg-cool-gray/5 rounded-full"></div>

                    <div class="relative z-10 w-24 h-24 bg-white rounded-2xl shadow-lg flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <i class="fas fa-briefcase text-5xl text-slate-navy"></i>
                    </div>

                    {{-- Badge tie hanya untuk yang di bawah 3 besar --}}
                    @if($index >= 3 && isset($tieScore) && $profesi->total_poin == $tieScore)
                        <span class="absolute top-3 left-3 bg-yellow-400 text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase shadow-md">Tie</span>
                    @endif
                </div>

                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="font-bold text-xl text-slate-navy mb-2 leading-tight">
                        {{ strtoupper($profesi->profesiKerja->nama_profesi_kerja) }}
                    </h3>

                    <div class="flex items-center gap-2 mb-4">
                        <span class="px-3 py-1 bg-slate-navy/5 text-slate-navy text-xs font-medium rounded-full">
                            Profesi Kerja
                        </span>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-cool-gray">Total Poin</span>
                            <span class="text-lg font-bold text-slate-navy">{{ $profesi->total_poin_normalized }}%</span>
                        </div>
                        <div class="w-full h-2 bg-border-gray/30 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-slate-navy to-cool-gray rounded-full transition-all duration-1000"
                                style="width: {{ min($profesi->total_poin_normalized, 100) }}%">
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-gradient-to-br from-slate-navy/5 to-transparent rounded-xl mb-6 border border-border-gray/20">
                        <p class="text-xs font-semibold text-slate-navy mb-1 uppercase tracking-wide">Mengapa cocok?</p>
                        <p class="text-sm text-cool-gray leading-relaxed">
                            {{ $alasanFormatted[$profesi->profesi_kerja_id] ?? 'Sesuai dengan profil kemampuanmu' }}
                        </p>
                    </div>

                    <a href="{{ route('siswa.eksplorasi-profesi.show', $profesi->profesiKerja->id) }}"
                        class="mt-auto group/btn relative inline-flex items-center justify-center px-6 py-3.5 bg-slate-navy text-white rounded-xl font-semibold overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-105">
                        <span class="relative z-10 flex items-center gap-2">
                            Lihat Detail Lengkap
                            <i class="fas fa-arrow-right transform group-hover/btn:translate-x-1 transition-transform"></i>
                        </span>
                        <div class="absolute inset-0 bg-cool-gray transform scale-x-0 group-hover/btn:scale-x-100 transition-transform origin-left"></div>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($extraCount > 0)
    <div class="text-center mt-6 mb-10">
        <button id="toggleMore"
            class="px-5 py-2.5 text-sm font-semibold rounded-full bg-slate-navy text-white hover:bg-cool-gray transition-all duration-300">
            +{{ $extraCount }} lainnya (persentase sama: {{ $profesi->total_poin_normalized }}%)
        </button>
    </div>

    <script>
        const btn = document.getElementById('toggleMore');
        const hiddenCards = document.querySelectorAll('.tie-card');
        let expanded = false;

        btn.addEventListener('click', () => {
            expanded = !expanded;
            hiddenCards.forEach(card => card.classList.toggle('hidden'));
            btn.textContent = expanded ? 'Tutup' : '+{{ $extraCount }} lainnya (persentase sama: {{ $profesi->total_poin_normalized }}%)';
        });
    </script>
@endif
