<h2 class="text-2xl font-bold text-slate-navy mb-6 text-center">Rekomendasi Berdasarkan Nilai UTBK</h2>

@forelse($rekomUTBK as $jurusanData)
    <h2 class="text-xl font-bold text-slate-navy mb-4">
        {{ $jurusanData['jurusan']->nama_jurusan_kuliah }} - Nilai UTBK : {{ $nilaiUtbk }}
    </h2>

    <div class="flex mb-12">
        <a href="{{ route('siswa.eksplorasi-jurusan.show', $jurusanData['jurusan']->id) }}"
            class="px-5 py-3 border border-slate-navy text-slate-navy text-sm font-semibold rounded-full shadow-lg hover:bg-slate-700 hover:text-off-white transition-all duration-300">
            Lihat Detail Jurusan
        </a>
    </div>

    @if(count($jurusanData['kampus']) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-12">
            @foreach($jurusanData['kampus'] as $index => $kampusData)
                <div class="group relative transition-all duration-500 hover:scale-105 hover:-translate-y-2">
                    <div class="bg-white rounded-2xl shadow-md border border-slate-200 hover:shadow-2xl transition-all duration-500 overflow-hidden h-full flex flex-col relative">

                        {{-- Status peluang --}}
                        <div class="absolute top-4 right-4 px-3 py-1 text-xs font-bold rounded-full
                            {{ $kampusData['status'] == 'Tinggi' ? 'bg-green-500 text-white' : ($kampusData['status']=='Sedang' ? 'bg-yellow-400 text-white' : 'bg-red-500 text-white') }}">
                            {{ $kampusData['status'] }}
                        </div>

                        {{-- Card Icon --}}
                        <div class="relative h-40 bg-gradient-to-br from-slate-navy/5 to-cool-gray/10 flex items-center justify-center overflow-hidden">
                            <div class="relative z-10 w-20 h-20 bg-white rounded-2xl shadow-lg flex items-center justify-center transform group-hover:scale-110 transition-all duration-500">
                                <i class="fas fa-university text-3xl text-slate-navy"></i>
                            </div>
                        </div>

                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="font-bold text-xl text-slate-navy mb-2">
                                {{ $kampusData['kampus']->nama_kampus }}
                            </h3>

                            <p class="text-sm text-cool-gray mb-2">
                                Passing Grade : {{ $kampusData['passing_grade'] ?? 'Belum tersedia' }}
                            </p>

                            <p class="text-sm text-cool-gray mb-4">
                                Selisih Nilai : {{ $kampusData['selisih'] }}
                            </p>

                            <p class="text-sm text-blue-500 mb-2 hover:underline">
                                Website :
                                <a href="{{ $kampusData['kampus']->website }}" target="_blank">
                                    {{ $kampusData['kampus']->website }}
                                </a>
                            </p>

                            <p class="text-sm text-cool-gray mb-2">
                                Alamat :
                                <a href="{{ $kampusData['kampus']->alamat }}">
                                    {{ $kampusData['kampus']->alamat }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-cool-gray mb-12 italic">
            Belum ada data kampus yang tersedia untuk jurusan ini
        </p>
    @endif
@empty
    <p class="text-center text-cool-gray mb-12 italic">
        Belum ada rekomendasi jurusan berdasarkan nilai UTBK
    </p>
@endforelse
