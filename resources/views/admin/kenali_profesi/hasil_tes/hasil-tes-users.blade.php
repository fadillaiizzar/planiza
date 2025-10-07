@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.kenali-profesi.hasil-tes.index') }}" class="btn btn-secondary">
            ← Kembali ke Daftar Tes
        </a>
    </div>

    <h5 class="mb-4">👥 Daftar Pengguna Tes: {{ $tes->nama_tes }}</h5>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jumlah Pengerjaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $i => $user)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    {{
                        ($user->siswa->kelas->nama_kelas ?? '-')
                        . ' ' .
                        ($user->siswa->jurusan->nama_jurusan ?? '')
                    }}
                </td>
                <td>{{ $user->total_pengerjaan }}</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary btn-detail" data-tes="{{ $tes->id }}" data-user="{{ $user->id }}">
                        Detail
                    </button>
                </td>
            </tr>
            <tr id="collapse-{{ $user->id }}" style="display:none;">
                <td colspan="5" class="bg-light p-3">
                    <div id="detail-{{ $user->id }}">Memuat...</div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Belum ada pengguna yang mengerjakan tes ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
document.querySelectorAll('.btn-detail').forEach(btn => {
    btn.addEventListener('click', async () => {
        const tesId = btn.dataset.tes;
        const userId = btn.dataset.user;
        const collapse = document.getElementById('collapse-' + userId);
        const detailDiv = document.getElementById('detail-' + userId);
        const isVisible = collapse.style.display === 'table-row';

        if (isVisible) {
            collapse.style.display = 'none';
            return;
        }

        detailDiv.innerHTML = '<div class="text-muted text-center">⏳ Memuat data...</div>';

        try {
            const res = await fetch(`/admin/kenali-profesi/hasil-tes/${tesId}/user/${userId}`);
            const data = await res.json();

            let html = `
                <h6 class="fw-bold mb-2">▼ Detail Pengerjaan ${data.nama}</h6>
                <table class="table table-sm mb-2">
                    <thead>
                        <tr>
                            <th>Pengerjaan ke</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${data.riwayat.map(r => `
                            <tr>
                                <td>${r.ke}</td>
                                <td>${r.tanggal}</td>
                                <td>
                                    <a href="/admin/hasil-tes/detail/${r.id_hasil}" class="btn btn-sm btn-outline-primary">
                                        🔍 Lihat Attempt
                                    </a>
                                </td>
                            </tr>`).join('')}
                    </tbody>
                </table>
                <div class="small text-muted">📊 Total ${data.total} pengerjaan</div>
            `;

            detailDiv.innerHTML = html;
            collapse.style.display = 'table-row';
        } catch (err) {
            detailDiv.innerHTML = `<div class="text-danger">Gagal memuat data.</div>`;
            console.error(err);
        }
    });
});
</script>
@endsection
