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

        @php
            $kontribusiCount = Auth::user()->kontribusiSdgs()->count();
            $target = 7;
        @endphp

        <!-- Riwayat Kontribusi + Button -->
        <div class="my-4 flex items-center justify-between gap-4">
            <span class="{{ $kontribusiCount >= $target ? 'text-success' : 'text-danger' }}">
                Riwayat kontribusi: {{ $kontribusiCount }} / {{ $target }}
            </span>

            <form action="{{ route('siswa.rekomendasi.sdgs.generate') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary"
                        @if($kontribusiCount < $target) disabled @endif>
                    Hasilkan Rekomendasi SDGs
                </button>
            </form>
        </div>

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
