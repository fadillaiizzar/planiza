@extends('layouts.siswa')

@section('title', 'Kenali Profesi - Siswa')

@section('content')
    <div class="px-4 py-8 sm:px-8">
        <x-siswa.section-header
            title="Kenali Profesi Kerja"
            subtitle="Temukan profesi kerja yang sesuai dengan dirimu melalui tes minat dan bakat. Jawab soal sederhana dan dapatkan rekomendasi karier yang cocok untukmu!"
            back-route="siswa.dashboard"
        />

        <x-siswa.info-siswa
            :siswa="$siswa"
        />

        <div class="min-h-screen bg-off-white py-12 px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    @include('siswa.kenali_profesi.benefit-left')

                    @include('siswa.kenali_profesi.benefit-right')
                </div>

                @include('siswa.kenali_profesi.banner-tes')
            </div>
        </div>

        @include('siswa.kenali_profesi.tes.riwayat-tes')

        @include('siswa.kenali_profesi.additional-link')
    </div>
@endsection

