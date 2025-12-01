@extends('layouts.siswa')

@section('title', 'Hasil Rekomendasi SDGs')

@section('content')
    <div class="container mx-auto px-4 py-6">

        <h1 class="text-2xl font-semibold mb-6 text-slate-700">Hasil Rekomendasi SDGs</h1>

        {{-- Info jumlah kontribusi --}}
        <div class="mb-6 p-4 bg-slate-50 rounded-lg border border-slate-200">
            <p class="text-slate-600">
                Berdasarkan {{ $kontribusiCount }} kontribusi yang kamu lakukan, berikut hasil rekomendasi dari sistem.
            </p>
        </div>

        {{-- Hasil kategori SDGs tertinggi --}}
        <div class="mb-8 p-5 bg-green-50 border border-green-200 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-green-700 mb-1.5">
                Kategori SDGs yang Paling Sesuai Dengan Kamu
            </h2>

            <p class="text-green-800 text-sm leading-relaxed">
                Dari seluruh kontribusi yang kamu lakukan, sistem menemukan bahwa
                <span class="font-semibold">{{ $kategoriTerpilih->nama_kategori }} {{ $kategoriTerpilih->nomor_kategori }}</span>
                merupakan kategori yang paling sering kamu tunjukkan melalui durasi kegiatan,
                jenis kegiatan, dan peran yang kamu ambil.
            </p>

            <p class="mt-2 text-green-600 text-xs">
                Total poin kategori ini: <span class="font-bold">{{ $kategoriTertinggiPoin }}</span>
            </p>
        </div>

        {{-- Rekomendasi Profesi --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-slate-700">Profesi yang Disarankan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($profesi as $p)
                    <div class="p-4 bg-white rounded-lg border border-slate-200 shadow-sm hover:shadow-md transition">
                        <h3 class="font-semibold text-slate-800 mb-2">
                            {{ $p->profesiKerja->nama_profesi_kerja }}
                        </h3>

                        <p class="text-slate-600 text-sm mb-2">
                            {{ Str::limit($p->profesiKerja->deskripsi, 120) }}
                        </p>

                        <p class="text-xs text-blue-600 font-medium">
                            • Skor kecocokan kata: {{ $p->total_poin }}
                        </p>
                    </div>
                @empty
                    <p class="text-slate-500">Belum ada rekomendasi profesi.</p>
                @endforelse
            </div>
        </div>

        {{-- Rekomendasi Jurusan --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 text-slate-700">Jurusan yang Disarankan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($jurusan as $j)
                    <div class="p-4 bg-white rounded-lg border border-slate-200 shadow-sm hover:shadow-md transition">
                        <h3 class="font-semibold text-slate-800 mb-2">
                            {{ $j->jurusanKuliah->nama_jurusan_kuliah }}
                        </h3>

                        <p class="text-slate-600 text-sm mb-2">
                            {{ Str::limit($j->jurusanKuliah->deskripsi, 120) }}
                        </p>

                        <p class="text-xs text-blue-600 font-medium">
                            • Skor kecocokan kata: {{ $j->total_poin }}
                        </p>
                    </div>
                @empty
                    <p class="text-slate-500">Belum ada rekomendasi jurusan.</p>
                @endforelse
            </div>
        </div>

        {{-- Button kembali --}}
        <div class="mt-6">
            <a href="{{ route('siswa.kontribusi-sdgs.index') }}"
            class="inline-block px-5 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-800 transition">
            Kembali ke Riwayat Kontribusi
            </a>
        </div>
    </div>
@endsection
