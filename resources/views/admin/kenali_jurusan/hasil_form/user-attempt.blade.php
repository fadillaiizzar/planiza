@extends('layouts.admin')

@section('title', 'Detail Attempt - ' . ($student->name ?? '-'))

@section('content')
<div class="mx-auto max-w-4xl p-6">
    <div class="mb-4">
        <a href="{{ route('admin.kenali-jurusan.hasil-form.user-history', $student->id) }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-slate-600 text-white rounded-xl hover:bg-slate-700 transition">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl p-8 shadow border border-border-gray/30">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-navy to-cool-gray flex items-center justify-center shadow-lg">
                <span class="text-white font-bold text-lg">#{{ $form->id }}</span>
            </div>
            <div>
                <h1 class="text-2xl font-bold">{{ $student->name }}</h1>
                <p class="text-sm text-cool-gray">Detail attempt</p>
            </div>
        </div>

        <div class="space-y-3">
            <p>Nilai UTBK: <strong>{{ $form->nilai_utbk ?? '-' }}</strong></p>

            <p>Jurusan Kuliah:</p>
            <ul>
                @foreach ($form->minats->pluck('jurusanKuliah')->filter() as $jurusan)
                    <li>{{ $jurusan->nama_jurusan ?? '-' }}</li>
                @endforeach
            </ul>

            <p>Hobi:</p>
            <ul>
                @foreach ($form->minats->pluck('hobi')->filter() as $hobi)
                    <li>{{ $hobi->nama_hobi ?? '-' }}</li>
                @endforeach
            </ul>

            <p>Rekomendasi Kampus:</p>
            <ul>
                @foreach ($form->minats->pluck('jurusanKuliah')->filter() as $jurusan)
                    @foreach ($jurusan->kampus as $kampus)
                        <li>{{ $kampus->nama_kampus }} - Passing Grade: {{ $kampus->pivot->passing_grade ?? '-' }}</li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
