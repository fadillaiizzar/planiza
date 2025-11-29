@php
    $showLimit = 4; // tampilkan 4 dulu
    $total = $riwayatKontribusi->count();
@endphp

<div class="max-w-6xl mx-auto mt-10 px-4">

    <!-- Section Header -->
    <div class="mb-10 flex items-center justify-between flex-wrap gap-4">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-slate-navy/10 rounded-xl flex items-center justify-center">
                <i class="fas fa-seedling text-xl text-slate-navy"></i>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-slate-navy">Riwayat Kontribusi SDGs</h2>
                <p class="text-cool-gray text-sm mt-1">Lihat kontribusi yang sudah kamu kirim dan detailnya</p>
            </div>
        </div>

        @if($total > 0)
            <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white rounded-full shadow-sm border border-border-gray/20">
                <i class="fas fa-check-double text-slate-navy text-sm"></i>
                <span class="text-sm font-medium text-cool-gray">
                    Total: <span>{{ $total }}</span> Kontribusi
                </span>
            </div>
        @endif
    </div>

    <!-- KOSONG -->
    @if($total === 0)
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-navy/5 to-transparent rounded-3xl"></div>
            <div class="relative bg-white border-2 border-dashed border-border-gray rounded-3xl p-12 text-center">
                <div class="w-24 h-24 bg-slate-navy/5 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                    <div class="absolute inset-0 bg-slate-navy/10 rounded-full animate-ping"></div>
                    <i class="fas fa-folder-open text-4xl text-cool-gray relative z-10"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-navy mb-3">Belum Ada Kontribusi</h3>
                <p class="text-cool-gray max-w-md mx-auto">Isi form kontribusi pertamamu untuk melihat riwayatnya!</p>
            </div>
        </div>
    @else
        <!-- GRID (default hanya 4 ditampilkan) -->
        <div id="riwayatGrid" class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            @foreach($riwayatKontribusi as $index => $item)
                <div class="riwayat-item
                    {{ $index >= $showLimit ? 'hidden' : '' }}
                    group relative bg-white rounded-2xl shadow-sm hover:shadow-xl border border-border-gray/20 overflow-hidden transition-all duration-500 hover:-translate-y-1">

                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-slate-navy via-cool-gray to-slate-navy transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>

                    <div class="p-5 flex flex-col md:flex-row md:items-center gap-4 md:gap-6">
                        <!-- Nomor -->
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-slate-navy/10 to-cool-gray/10 rounded-xl flex items-center justify-center border border-border-gray/30 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-lg font-bold text-slate-navy">#{{ $index+1 }}</span>
                        </div>

                        <!-- Detail -->
                        <div class="flex-grow min-w-0">
                            <h3 class="font-bold text-base text-slate-navy mb-1.5 truncate group-hover:text-cool-gray transition-colors">
                                {{ $item->judul_kegiatan }}
                            </h3>

                            <span class="text-xs mb-2 inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-navy/5 text-slate-navy font-medium rounded-full border border-border-gray/30">
                                <i class="fas fa-check-circle text-[9px]"></i>
                                {{ Str::limit($item->kategoriSdgs->nama_kategori ?? '-', 32) }}
                            </span>

                            <div class="flex items-center gap-3 text-xs text-cool-gray flex-wrap">
                                <span class="flex items-center gap-1.5">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $item->tanggal_pelaksanaan->format('d M Y') }}
                                </span>

                                <span class="flex items-center gap-1.5">
                                    @if($item->status === 'approved')
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    @elseif($item->status === 'rejected')
                                        <i class="fas fa-times-circle text-red-600"></i>
                                    @else
                                        <i class="fas fa-hourglass-half text-yellow-600"></i>
                                    @endif

                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="mt-4 md:mt-0 md:ml-auto">
                            <button onclick="openDetailKontribusi({{ $item->id }})"
                                class="group/btn flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-navy text-white rounded-xl font-semibold text-sm overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-105">
                                <div class="absolute inset-0 bg-cool-gray transform scale-x-0 group-hover/btn:scale-x-100 transition-transform origin-left duration-300"></div>
                                <span class="relative z-10 flex items-center gap-2">
                                    <i class="fas fa-eye text-sm"></i>
                                    Detail
                                    <i class="fas fa-arrow-right text-xs transform group-hover/btn:translate-x-1 transition-transform"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- BUTTON LIHAT SEMUA -->
        @if($total > $showLimit)
            <div class="text-center mt-6">
                <button id="showMoreBtn" class="px-5 py-2 rounded-full border border-slate-300 text-slate-600 text-sm font-medium hover:bg-slate-100 transition-colors" data-state="less">
                    Lihat Semua Kontribusi
                </button>
            </div>
        @endif
    @endif
</div>

@include('siswa.kontribusi_sdgs.modal-detail-kontribusi')

<script>
    const showLimit = {{ $showLimit }};
    const totalItems = {{ $total }};
    const items = document.querySelectorAll('.riwayat-item');
    const btn = document.getElementById('showMoreBtn');

    if (btn) {
        btn.addEventListener('click', function () {

            const showingAll = this.dataset.state === "all";

            if (!showingAll) {
                // 🔥 Tampilkan semua
                items.forEach(el => el.classList.remove('hidden'));
                this.textContent = "Tampilkan Lebih Sedikit";
                this.dataset.state = "all";
            } else {
                // 🔥 Kembalikan ke 4 item
                items.forEach((el, index) => {
                    if (index >= showLimit) {
                        el.classList.add('hidden');
                    }
                });
                this.textContent = "Lihat Semua Kontribusi";
                this.dataset.state = "less";
            }
        });
    }
</script>

