@extends('layouts.siswa')
@section('title', 'Rekomendasi Profesi')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-off-white via-white to-off-white">
    <div class="px-4 py-8 sm:px-8">
        <x-siswa.section-header
            title="Rekomendasi Profesi"
            subtitle="Temukan tiga profesi teratas yang cocok dengan potensi dan minatmu"
            back-route="siswa.kenali-profesi.index"
        />
        <x-siswa.info-siswa :siswa="$siswa" />

        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            @include('siswa.kenali_profesi.tes.rekomendasi_profesi.hero')

            @include('siswa.kenali_profesi.tes.rekomendasi_profesi.top-profesi-card', [
                'topProfesi' => $topProfesi,
                'alasanFormatted' => $alasanFormatted
            ])

            @include('siswa.kenali_profesi.tes.rekomendasi_profesi.bottom-info')
        </div>
    </div>
</div>
@endsection
