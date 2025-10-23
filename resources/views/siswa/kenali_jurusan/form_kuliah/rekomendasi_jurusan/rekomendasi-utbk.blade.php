<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-navy mb-3">
            Rekomendasi Berdasarkan Nilai UTBK
        </h2>
        <div class="w-24 h-1 bg-slate-navy mx-auto"></div>
    </div>

    @forelse($rekomUTBK as $jurusanData)
        <div class="mb-20">
            {{-- Header Jurusan --}}
            @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi_utbk.header-jurusan')

            @if(count($jurusanData['kampus']) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($jurusanData['kampus'] as $index => $kampusData)
                        <div class="group relative">
                            <div class="bg-white rounded-3xl border border-border-gray hover:border-slate-navy transition-all duration-300 overflow-hidden h-full flex flex-col shadow-sm hover:shadow-xl">

                                {{-- Header Card --}}
                                @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi_utbk.header-card')

                                {{-- Content --}}
                                <div class="p-6 flex-grow flex flex-col">
                                    @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi_utbk.nama-kampus')

                                    {{-- Info Grid --}}
                                    <div class="space-y-3 mb-4">
                                        @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi_utbk.passing-grade')
                                        @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi_utbk.pencapaian-nilai')
                                    </div>

                                    @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi_utbk.keterangan')

                                    {{-- Footer Info --}}
                                    @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi_utbk.footer-info')
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi_utbk.empty-kampus')
            @endif
        </div>
    @empty
        @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi_utbk.empty-rekomendasi')
    @endforelse
</div>
