@php
    $kontribusiCount = Auth::user()->kontribusiSdgs()->count();
    $target = 7;
@endphp

<!-- Riwayat Kontribusi + Button -->
<div class="my-6 max-w-6xl mx-auto ">
    <!-- Progress Section -->
    <div class="mb-4">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-slate-navy">Riwayat Kontribusi</span>
            <span class="text-sm font-semibold {{ $kontribusiCount >= $target ? 'text-emerald-600' : 'text-cool-gray' }}">
                {{ $kontribusiCount }} / {{ $target }}
            </span>
        </div>

        <!-- Progress Bar -->
        <div class="w-full h-2 bg-border-gray rounded-full overflow-hidden">
            <div class="h-full transition-all duration-500 ease-out rounded-full {{ $kontribusiCount >= $target ? 'bg-emerald-600' : 'bg-cool-gray' }}"
                style="width: {{ min(($kontribusiCount / $target) * 100, 100) }}%">
            </div>
        </div>
    </div>

    <!-- Info Message (when incomplete) -->
    @if($kontribusiCount < $target)
    <div class="mb-4 p-4 bg-amber-50 border border-amber-200 rounded-lg">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <p class="text-sm font-medium text-amber-900">Data belum lengkap</p>
                <p class="text-xs text-amber-700 mt-1">Lengkapi {{ $target - $kontribusiCount }} kontribusi lagi untuk menghasilkan rekomendasi SDGs</p>
            </div>
        </div>
    </div>
    @endif

    <div class="flex justify-center items-center gap-4">
        <!-- Generate Button -->
        <form action="{{ route('siswa.rekomendasi-sdgs.generate') }}" method="POST">
            @csrf
            <button type="submit"
                    class="py-3 px-6 rounded-lg font-medium text-sm flex items-center justify-center gap-2
                        {{ $kontribusiCount >= $target
                            ? 'bg-slate-navy text-white hover:bg-slate-navy/90 shadow-sm hover:shadow-md active:scale-[0.98]'
                            : 'bg-border-gray text-cool-gray cursor-not-allowed' }}"
                    @if($kontribusiCount < $target) disabled @endif>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span>{{ $kontribusiCount >= $target ? 'Hasilkan Rekomendasi SDGs' : 'Lengkapi Data Terlebih Dahulu' }}</span>
            </button>
        </form>

        <!-- Lihat Hasil Terakhir -->
        @if($kontribusiCount >= $target)
            <a href="{{ route('siswa.rekomendasi-sdgs.hasil') }}"
            class="py-3 px-6 rounded-lg font-medium text-sm text-slate-navy border border-slate-navy text-center hover:bg-slate-navy/10 transition-all duration-200">
                Lihat Hasil Terakhir
            </a>
        @endif
    </div>


    <!-- Success Message (when complete) -->
    @if($kontribusiCount >= $target)
    <p class="text-xs text-center text-cool-gray mt-3">
        Klik tombol untuk mendapatkan rekomendasi SDGs berdasarkan kontribusimu
    </p>
    @endif
</div>
