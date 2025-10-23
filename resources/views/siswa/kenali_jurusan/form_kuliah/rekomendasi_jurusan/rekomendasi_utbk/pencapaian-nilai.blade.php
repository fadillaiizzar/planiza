<div class="flex items-start gap-3">
    <div class="w-2 h-2 bg-slate-navy rounded-full mt-2 flex-shrink-0"></div>
    <div class="flex-grow">
        <p class="text-sm text-cool-gray">Pencapaian Nilai</p>
        <div class="flex items-center gap-2">
            <div class="relative flex-grow bg-border-gray rounded-full h-3 overflow-hidden">
                {{-- Layer 1: batas maksimum (1000) --}}
                <div class="absolute inset-0 bg-border-gray"></div>

                {{-- Layer 2: Passing Grade --}}
                <div class="absolute left-0 top-0 h-full rounded-full bg-slate-navy"
                    style="width: {{ ($kampusData['passing_grade'] / 1000) * 100 }}%">
                </div>

                {{-- Hitung persentase nilai dan warna --}}
                @php
                    $passingGrade = $kampusData['passing_grade'] ?? 0;
                    $persentUtbk = $nilaiUtbk > 0 ? ($nilaiUtbk / 1000) * 100 : 0;
                    $persentPG = $passingGrade > 0 ? ($passingGrade / 1000) * 100 : 0;

                    if ($passingGrade > 0) {
                        $perbandingan = ($nilaiUtbk / $passingGrade) * 100;
                    } else {
                        $perbandingan = 0;
                    }

                    if ($perbandingan >= 100) {
                        $warna = 'bg-slate-navy';
                    } elseif ($perbandingan >= 80) {
                        $warna = 'bg-yellow-400';
                    } else {
                        $warna = 'bg-red-500';
                    }

                    // Batasi UTBK max 1000 agar tidak lebih dari 100%
                    $persentUtbk = min($persentUtbk, 100);
                @endphp

                {{-- Layer 3: Nilai UTBK --}}
                <div class="absolute left-0 top-0 h-full rounded-full {{ $warna }}"
                    style="width: {{ $persentUtbk }}%">
                </div>

                {{-- Layer 4: Jika nilai UTBK lebih tinggi dari Passing Grade,
                    tambahkan overlay kecil warna hijau muda di area setelah PG --}}
                @if ($nilaiUtbk > $passingGrade && $passingGrade > 0)
                    <div class="absolute top-0 h-full bg-green-500 rounded-r-full"
                        style="left: {{ $persentPG }}%; width: {{ $persentUtbk - $persentPG }}%;">
                    </div>
                @endif
            </div>

            <span class="font-semibold text-slate-navy text-sm">
                {{ $nilaiUtbk }}/1000
            </span>
        </div>
    </div>
</div>
