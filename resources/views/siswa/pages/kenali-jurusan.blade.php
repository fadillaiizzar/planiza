@extends('layouts.siswa')

@section('title', 'Kenali Jurusan - Siswa')

@section('content')
    <div class="px-4 py-8 sm:px-8">
        <x-siswa.section-header
            title="Kenali Jurusan Kuliah"
            subtitle="Ingin tahu peluangmu di jurusan impian? Masukkan nilai UTBK dan temukan status kelolosanmu berdasarkan passing grade kampus!"
            back-route="siswa.dashboard"
        />

        <x-siswa.info-siswa
            :siswa="$siswa"
        />

        <div class="min-h-screen bg-off-white py-12 px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    @include('siswa.kenali_jurusan.benefit-left')

                    @include('siswa.kenali_jurusan.benefit-right')
                </div>

                @include('siswa.kenali_jurusan.banner-form')
            </div>
        </div>

        {{-- @include('siswa.kenali_profesi.tes.riwayat-tes') --}}

        <x-siswa.kenali_karier.additional-link
            :href="route('siswa.kenali-profesi.index')"
            text="Coba Kenali Profesi Kerja"
        />
    </div>
@endsection

