@extends('layouts.siswa')
@section('title', 'Rekomendasi Jurusan')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-off-white via-white to-off-white">
    <div class="px-4 py-8 sm:px-8">
        <x-siswa.section-header
            title="Rekomendasi Jurusan"
            subtitle="Temukan jurusan dan kampus yang paling sesuai dengan minat dan potensi UTBK-mu"
            back-route="siswa.kenali-jurusan.index"
        />
        <x-siswa.info-siswa :siswa="Auth::user()->siswa" />

        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            <x-siswa.kenali_karier.hero-rekomendasi
                title="Jurusan & Kampus Impianmu"
                desc="Berdasarkan analisis UTBK dan minat hobimu, kami menemukan jurusan dan kampus yang paling cocok"
            />

            @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi-utbk')

            @include('siswa.kenali_jurusan.form_kuliah.rekomendasi_jurusan.rekomendasi-hobi')

            <x-siswa.kenali_karier.bottom-info
                desc='Klik "Lihat Detail Jurusan" untuk mempelajari lebih dalam tentang setiap jurusan, termasuk kampus, passing grade, dan peluang diterima'
            />
        </div>
    </div>
</div>
@endsection
