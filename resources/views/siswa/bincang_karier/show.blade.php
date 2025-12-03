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

    @include('siswa.bincang_karier.question')

    @include('siswa.bincang_karier.comments_header')

    @php
        $total = $bincangKarier->tanggapanKarier->count();
        $firstThree = $bincangKarier->tanggapanKarier->take(3);
        $moreTanggapan = $bincangKarier->tanggapanKarier->skip(3);
    @endphp

    @if($total === 0)
        <p class="text-gray-500 text-sm italic mb-4">
            Belum ada tanggapan. Jadilah yang pertama membalas.
        </p>
    @else
        <div class="max-h-72 overflow-y-auto border border-gray-200 rounded-xl bg-white divide-y divide-gray-100">
            @foreach($bincangKarier->tanggapanKarier as $tanggapan)
                <div class="p-4">
                    @include('siswa.bincang_karier.item')
                </div>
            @endforeach
        </div>
    @endif

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
