@php
    $selectedIds = $soal->jawabanSiswa
        ? $soal->jawabanSiswa->pluck('opsi_jawaban_id')->toArray()
        : [];
@endphp

<div class="grid gap-4 sm:gap-5 max-w-3xl mx-auto">
    @foreach ($soal->opsiJawabans as $opsiIndex => $opsi)
        @php
            $isSelected = in_array($opsi->id, $selectedIds);
        @endphp

        <button class="group opsi-btn relative overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-[1.02] transform rounded-2xl
            {{ $isSelected
                ? 'bg-blue-600 border-2 border-blue-600 shadow-xl scale-[1.02]'
                : 'bg-white hover:bg-blue-50 border-2 border-border-gray/30 hover:border-blue-300/50' }}"
            data-soal="{{ $soal->id }}"
            data-opsi="{{ $opsi->id }}">

            <div class="flex items-center space-x-4 p-5 sm:p-3">
                <!-- Option Letter Badge -->
                <div class="flex-shrink-0 w-12 h-12 rounded-xl border-2 flex items-center justify-center font-bold text-base transition-all duration-300
                    {{ $isSelected
                        ? 'bg-white/20 border-white/40 text-white'
                        : 'border-border-gray/50 text-cool-gray group-hover:border-blue-400 group-hover:bg-blue-50' }}">
                    {{ chr(65 + $opsiIndex) }}
                </div>

                <!-- Option Text -->
                <div class="flex-1 text-left">
                    <p class="font-medium leading-relaxed text-base transition-colors duration-300
                        {{ $isSelected ? 'text-white' : 'text-slate-navy' }}">
                        {{ $opsi->isi_opsi }}
                    </p>
                </div>
            </div>

            <!-- Hover Effect Background -->
            <div class="absolute inset-0 bg-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
        </button>
    @endforeach
</div>
