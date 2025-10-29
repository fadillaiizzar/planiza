@extends('layouts.admin')

@section('title', 'Detail Attempt - ' . ($student->name ?? '-'))

@section('content')
<div class="mx-auto max-w-6xl p-6 space-y-10">

    {{-- Tombol Kembali --}}
    <div class="mb-4">
        <a href="{{ route('admin.kenali-jurusan.hasil-form.user-history', $student->id) }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-slate-600 text-white rounded-xl hover:bg-slate-700 transition">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- Header Info Siswa --}}
    <div class="bg-white p-8 rounded-2xl shadow border border-gray-200">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-slate-700 text-white font-bold text-xl rounded-2xl flex items-center justify-center shadow">
                #{{ $form->id }}
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-800">{{ $student->name }}</h1>
                <p class="text-sm text-gray-500">Attempt ke-{{ $form->attempt ?? 1 }}</p>
            </div>
        </div>

        <div class="mt-6 border-t pt-6">
            <h2 class="text-xl font-semibold text-slate-800 mb-4">🧾 Jawaban Form Siswa</h2>

            <div class="space-y-2 text-slate-700">
                <p>Nilai UTBK:
                    <span class="font-bold text-slate-900">{{ $form->nilai_utbk ?? '-' }}</span>
                </p>

                <div>
                    <p class="font-medium">Jurusan yang Dipilih:</p>
                    <ul class="list-disc list-inside text-gray-700">
                        @forelse ($form->minats->pluck('jurusanKuliah')->filter() as $jurusan)
                            <li>{{ $jurusan->nama_jurusan_kuliah ?? '-' }}</li>
                        @empty
                            <li class="italic text-gray-500">Belum memilih jurusan.</li>
                        @endforelse
                    </ul>
                </div>

                <div>
                    <p class="font-medium">Hobi yang Dipilih:</p>
                    <ul class="list-disc list-inside text-gray-700">
                        @forelse ($form->minats->pluck('hobi')->filter() as $hobi)
                            <li>{{ $hobi->nama_hobi ?? '-' }}</li>
                        @empty
                            <li class="italic text-gray-500">Belum memilih hobi.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== REKOMENDASI BERDASARKAN UTBK ===================== --}}
    <section>
        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            🎯 Rekomendasi Berdasarkan Nilai UTBK
        </h2>

        @forelse ($form->minats->pluck('jurusanKuliah')->filter() as $jurusan)
            <div class="mb-10 bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 bg-slate-700 text-white flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-semibold">{{ $jurusan->nama_jurusan_kuliah }}</h3>
                        <p class="text-sm text-gray-200">Dari hasil nilai UTBK siswa</p>
                    </div>
                    <a href="{{ route('siswa.eksplorasi-jurusan.show', $jurusan->id) }}"
                       class="inline-flex items-center gap-2 bg-white text-slate-800 font-medium px-4 py-2 rounded-xl hover:bg-gray-100 transition">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

               <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                    @foreach ($jurusan->kampus as $kampus)
                        @php
                            $passingGrade = $kampus->pivot->passing_grade ?? 0;
                            $nilaiUtbk = $form->nilai_utbk ?? 0;

                            // Perbandingan nilai UTBK dengan Passing Grade
                            $perbandingan = $passingGrade > 0 ? ($nilaiUtbk / $passingGrade) * 100 : 0;

                            // Warna utama bar (berdasarkan perbandingan)
                            if ($perbandingan >= 100) {
                                $warna = 'bg-slate-navy';
                                $status = 'Tinggi';
                                $ket = 'Nilai melebihi passing grade 🎉';
                            } elseif ($perbandingan >= 80) {
                                $warna = 'bg-yellow-400';
                                $status = 'Sedang';
                                $ket = 'Nilai mendekati passing grade, masih ada peluang!';
                            } else {
                                $warna = 'bg-red-500';
                                $status = 'Rendah';
                                $ket = 'Nilai masih di bawah passing grade.';
                            }

                            // Konversi ke skala 1000 (seperti tampilan siswa)
                            $persentUtbk = min(($nilaiUtbk / 1000) * 100, 100);
                            $persentPG = min(($passingGrade / 1000) * 100, 100);
                        @endphp

                        <div class="relative bg-white border rounded-2xl p-6 pt-12 shadow-sm hover:shadow-md transition">
                            {{-- Status Badge --}}
                            <span class="absolute top-3 right-3 px-3 py-1 text-xs font-bold rounded-full text-white {{ $warna }}">
                                Peluang {{ $status }}
                            </span>

                            {{-- Nama Kampus --}}
                            <h4 class="font-bold text-xl text-slate-navy mb-4 line-clamp-2">
                                {{ $kampus->nama_kampus }}
                            </h4>

                            {{-- Passing Grade --}}
                            <p class="text-sm text-gray-500 mb-3">Passing Grade: {{ $passingGrade ?: '-' }}</p>

                            {{-- Pencapaian Nilai (versi siswa) --}}
                            <div class="flex items-start gap-3 mb-4">
                                <div class="w-2 h-2 bg-slate-navy rounded-full mt-2 flex-shrink-0"></div>
                                <div class="flex-grow">
                                    <p class="text-sm text-cool-gray">Pencapaian Nilai</p>
                                    <div class="flex items-center gap-2">
                                        <div class="relative flex-grow bg-border-gray rounded-full h-3 overflow-hidden">
                                            {{-- Layer 1: batas maksimum (1000) --}}
                                            <div class="absolute inset-0 bg-border-gray"></div>

                                            {{-- Layer 2: Passing Grade --}}
                                            <div class="absolute left-0 top-0 h-full rounded-full bg-slate-navy"
                                                style="width: {{ $persentPG }}%">
                                            </div>

                                            {{-- Layer 3: Nilai UTBK --}}
                                            <div class="absolute left-0 top-0 h-full rounded-full {{ $warna }}"
                                                style="width: {{ $persentUtbk }}%">
                                            </div>

                                            {{-- Layer 4: Jika nilai UTBK > Passing Grade --}}
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

                            {{-- Keterangan Peluang --}}
                            <p class="text-sm text-gray-600 italic mb-4">{{ $ket }}</p>

                            {{-- Info Tambahan --}}
                            <div class="border-t pt-3 mt-auto text-sm text-gray-600 space-y-1">
                                <a href="{{ $kampus->website }}" target="_blank" class="flex items-center gap-2 hover:underline">
                                    <i class="fas fa-globe"></i> {{ $kampus->website ?? 'Website belum tersedia' }}
                                </a>
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-map-marker-alt mt-1"></i>
                                    <span>{{ $kampus->alamat ?? 'Alamat tidak tersedia' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-gray-500 italic">Belum ada rekomendasi berdasarkan nilai UTBK.</p>
        @endforelse
    </section>

    {{-- ===================== REKOMENDASI BERDASARKAN HOBI ===================== --}}
    <section>
        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            💡 Rekomendasi Berdasarkan Hobi
        </h2>

        @php
            $hobiList = $form->minats->pluck('hobi')->filter();
        @endphp

        @forelse ($hobiList as $hobi)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 mb-6">
                <h3 class="text-xl font-semibold text-slate-800 mb-3">
                    {{ $hobi->nama_hobi }}
                </h3>
                <p class="text-sm text-gray-600 mb-4">Hobi ini direkomendasikan untuk jurusan-jurusan berikut:</p>

                @if ($hobi->jurusanKuliahs->count() > 0)
                    <ul class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($hobi->jurusanKuliahs as $jurusan)
                            <li class="border border-gray-200 rounded-xl p-4 hover:bg-slate-50 transition">
                                <h4 class="font-semibold text-slate-700">{{ $jurusan->nama_jurusan_kuliah }}</h4>
                                <a href="{{ route('siswa.eksplorasi-jurusan.show', $jurusan->id) }}"
                                   class="text-sm text-slate-600 hover:text-slate-800 inline-flex items-center gap-1 mt-1">
                                    <i class="fas fa-arrow-right"></i> Lihat Detail
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 italic">Belum ada jurusan yang cocok dengan hobi ini.</p>
                @endif
            </div>
        @empty
            <p class="text-gray-500 italic">Tidak ada data hobi untuk siswa ini.</p>
        @endforelse
    </section>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
