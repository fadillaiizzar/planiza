<div class="max-w-6xl mx-auto mt-10 px-4">

    <!-- Section Header -->
    <div class="mb-10">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-slate-navy/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-history text-xl text-slate-navy"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-slate-navy">Riwayat Tes</h2>
                    <p class="text-cool-gray text-sm mt-1">Lihat kembali hasil tes yang pernah kamu kerjakan</p>
                </div>
            </div>

            @if(!$riwayatTes->isEmpty())
                <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white rounded-full shadow-sm border border-border-gray/20">
                    <i class="fas fa-check-double text-slate-navy text-sm"></i>
                    <span class="text-sm font-medium text-cool-gray">
                        Total : <span>{{ $riwayatTes->count() }}</span> Tes
                    </span>
                </div>
            @endif
        </div>
    </div>

    @if($riwayatTes->isEmpty())
        <!-- Empty State -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-navy/5 to-transparent rounded-3xl"></div>

            <div class="relative bg-white border-2 border-dashed border-border-gray rounded-3xl p-12 text-center">

                <!-- Icon Container -->
                <div class="w-24 h-24 bg-slate-navy/5 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                    <div class="absolute inset-0 bg-slate-navy/10 rounded-full animate-ping"></div>
                    <i class="fas fa-clipboard-list text-4xl text-cool-gray relative z-10"></i>
                </div>

                <h3 class="text-2xl font-bold text-slate-navy mb-3">
                    Belum Ada Riwayat Tes
                </h3>
                <p class="text-cool-gray max-w-md mx-auto">
                    Mulai perjalanan kariermu dengan mengikuti tes minat dan bakat pertamamu!
                </p>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 items-stretch">
            @foreach($riwayatTes as $index => $tes)
                @php
                    $userId = Auth::id();
                    // ambil semua hasil (semua attempt) dari tes ini
                    $results = $tes->kenaliProfesis()
                        ->where('user_id', $userId)
                        ->select('attempt', \DB::raw('MAX(updated_at) as updated_at'))
                        ->groupBy('attempt')
                        ->orderBy('attempt', 'asc')
                        ->get();
                @endphp

                @foreach($results as $result)
                    <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl border border-border-gray/20 overflow-hidden transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-slate-navy via-cool-gray to-slate-navy transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>

                        <div class="p-5">
                            <div class="flex flex-col sm:flex-row md:items-center gap-4 md:gap-6">

                                <!-- Nomor -->
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-slate-navy/10 to-cool-gray/10 rounded-xl flex items-center justify-center border border-border-gray/30 group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-lg font-bold text-slate-navy">#{{ $result->attempt }}</span>
                                </div>

                                <!-- Konten Tes -->
                                <div class="flex-grow min-w-0">
                                    <h3 class="font-bold text-base text-slate-navy mb-1.5 truncate group-hover:text-cool-gray transition-colors">
                                        {{ $tes->nama_tes }}
                                    </h3>

                                    <div class="flex items-center gap-3 text-xs text-cool-gray">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-navy/5 text-slate-navy font-medium rounded-full border border-border-gray/30">
                                            <i class="fas fa-check-circle text-[9px]"></i>
                                            Selesai {{ $result->attempt }}
                                        </span>

                                        <span class="flex items-center gap-1.5">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $result->updated_at->format('d M Y, H:i') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="mt-4 md:mt-0 md:ml-auto order-last md:order-none">
                                    <a href="{{ route('siswa.kenali-profesi.tes.rekomendasi', [$tes->id, 'attempt' => $result->attempt]) }}"
                                    class="group/btn w-full md:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-navy text-white rounded-xl font-semibold text-sm overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-105">
                                        <div class="absolute inset-0 bg-cool-gray transform scale-x-0 group-hover/btn:scale-x-100 transition-transform origin-left duration-300"></div>
                                        <span class="relative z-10 flex items-center gap-2">
                                            <i class="fas fa-eye text-sm"></i>
                                            Detail {{ $result->attempt }}
                                            <i class="fas fa-arrow-right text-xs transform group-hover/btn:translate-x-1 transition-transform"></i>
                                        </span>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="absolute bottom-0 right-0 w-20 h-20 bg-slate-navy/5 rounded-tl-full transform translate-x-10 translate-y-10 group-hover:scale-150 transition-transform duration-500"></div>
                    </div>
                @endforeach
            @endforeach
        </div>
    @endif
</div>
