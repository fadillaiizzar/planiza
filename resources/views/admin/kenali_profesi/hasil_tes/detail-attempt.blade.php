@extends('layouts.admin')

@section('title', 'Detail Attempt - Planiza')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-off-white via-white to-off-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Back Button -->
        @include('admin.kenali_profesi.hasil_tes.detail_attempt.back-button')

        <!-- Header Section -->
        @include('admin.kenali_profesi.hasil_tes.detail_attempt.header-section')

        <!-- Jawaban Section -->
        @include('admin.kenali_profesi.hasil_tes.detail_attempt.daftar-jawaban')

        <!-- Rekomendasi Teratas Section with Premium Cards -->
        @include('admin.kenali_profesi.hasil_tes.detail_attempt.rekomendasi-profesi-card')

        <!-- Rekap Poin Section with Grid Layout -->
        @include('admin.kenali_profesi.hasil_tes.detail_attempt.rekap-poin')
        
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
