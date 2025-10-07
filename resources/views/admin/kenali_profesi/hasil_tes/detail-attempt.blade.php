@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <a href="{{ route('admin.kenali-profesi.hasil-tes.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <h4 class="fw-bold mb-3">
        Detail Attempt {{ $attempt }} - {{ $user->name }} <br>
        <small class="text-muted">{{ $tes->nama_tes }}</small>
    </h4>

    <hr>

    <h5>📝 Daftar Jawaban</h5>
    <table class="table table-bordered table-striped align-middle mt-2">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
                <th>Poin</th>
                <th>Mengarah ke Profesi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse ($jawaban as $soal)
                @foreach ($soal['jawaban'] as $idx => $jwb)
                    <tr>
                        @if ($idx == 0)
                            <td rowspan="{{ count($soal['jawaban']) }}">{{ $no++ }}</td>
                            <td rowspan="{{ count($soal['jawaban']) }}">{{ $soal['pertanyaan'] }}</td>
                        @endif
                        <td>{{ $jwb['isi_opsi'] }}</td>
                        <td>{{ $jwb['poin'] }}</td>
                        <td>{{ $jwb['profesi_tujuan'] ?? '-' }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada jawaban.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    <hr>

    <h5>📊 Rekap Total Poin per Profesi</h5>
    <table class="table table-sm table-bordered mt-2">
        <thead class="table-secondary">
            <tr>
                <th>No</th>
                <th>Profesi</th>
                <th>Total Poin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($poinProfesi as $i => $profesi)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $profesi->nama_profesi_kerja }}</td>
                <td>{{ $profesi->total_poin }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <h5>🏆 Rekomendasi Teratas</h5>
    <div class="row">
        @foreach ($topProfesi as $profesi)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <h6 class="fw-bold">{{ $profesi->nama_profesi_kerja }}</h6>
                    <p class="text-muted small">Total Poin: {{ $profesi->total_poin }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
