@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">📊 Manajemen Hasil Tes</h4>

    <table class="table table-bordered align-middle table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Tes</th>
                <th>Jumlah User</th>
                <th>Jumlah Pengerjaan</th>
                <th>Update Terakhir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $i => $tes)
            <tr id="row-{{ $tes->id }}">
                <td>{{ $i + 1 }}</td>
                <td>{{ $tes->nama_tes }}</td>
                <td>{{ $tes->jumlah_user }}</td>
                <td>{{ $tes->jumlah_pengerjaan }}</td>
                <td>{{ optional($tes->kenaliProfesis->first()?->updated_at)->format('d M H:i') ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.kenali-profesi.hasil-tes.users', $tes->id) }}" class="btn btn-sm btn-primary">
                        Detail
                    </a>
                </td>
            </tr>
            <!-- Baris collapse detail -->
            <tr id="collapse-{{ $tes->id }}" class="collapse-row" style="display:none;">
                <td colspan="6" class="bg-light p-3">
                    <div id="detail-{{ $tes->id }}">Loading...</div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada data tes</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
