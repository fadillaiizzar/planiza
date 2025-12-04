@extends('layouts.siswa')

@section('title', 'Detail Bincang Karier')

@section('content')

<div id="main-content" class="px-4 py-8 sm:px-8">

    {{-- Header Section --}}
    <x-siswa.section-header
        title="Detail Bincang Karier"
        subtitle="Lihat detail pertanyaan dan diskusi bersama konselor."
        back-route="siswa.bincang-karier.index"
    />

    {{-- Question --}}
    @include('siswa.bincang_karier.question')

    {{-- Comments List --}}
    @include('siswa.bincang_karier.comments')

    {{-- Form Reply --}}
    @include('siswa.bincang_karier.form_reply')
</div>
@endsection

@push('scripts')
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }
    </script>
@endpush
