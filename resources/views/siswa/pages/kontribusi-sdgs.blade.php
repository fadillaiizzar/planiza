@extends('layouts.siswa')

@section('title', 'Kontribusi SDGs - Siswa')

@section('content')
    <div class="px-4 py-8 sm:px-8">
        <x-siswa.section-header
            title="Kontribusi terhadap SDGs"
            subtitle="Pelajari dan isi kontribusimu terhadap 17 Tujuan Pembangunan Berkelanjutan (SDGs). Setiap tindakan kecil yang kamu lakukan bisa membawa dampak besar bagi lingkungan, masyarakat, dan masa depan yang berkelanjutan."
            back-route="siswa.dashboard"
        />

        <x-siswa.info-siswa :siswa="$siswa" />

        <!-- Hero Section - Ultra Modern -->
        @include('siswa.kontribusi_sdgs.hero-section')

        <!-- 17 SDGs Categories - Minimalist Grid -->
        @include('siswa.kontribusi_sdgs.sdgs-categories')

        <!-- CTA Banner - Ultra Modern -->
        @include('siswa.kontribusi_sdgs.banner-kontribusi')

        @include('siswa.kontribusi_sdgs.progress-kontribusi')

        @include('siswa.kontribusi_sdgs.riwayat-kontribusi')

        <!-- Benefits Section - Modern Cards -->
        @include('siswa.kontribusi_sdgs.benefit-section')
    </div>

    <!-- Modal Detail SDG - Clean Design -->
    @include('siswa.kontribusi_sdgs.modal-detail-sdgs')

    <!-- Modal Kontribusi - No Scrollbar -->
    @include('siswa.kontribusi_sdgs.modal-kontribusi-sdgs')

    <!-- Modal SDGs Guide - Clean -->
    @include('siswa.kontribusi_sdgs.modal-sdgs-guide')
@endsection

@push('scripts')
    <script>
        const sdgsData = @json($kategoriSdgs);
    </script>

    <script src="{{ asset('js/siswa/kontribusi_sdgs/kontribusi-sdgs.js') }}"></script>
@endpush
