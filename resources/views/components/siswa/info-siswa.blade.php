<div class="flex flex-wrap items-center gap-4 text-sm text-slate-700 mb-6">
    @if($siswa)
        <div class="flex items-center space-x-2">
            <i class="fas fa-graduation-cap text-blue-500"></i>
            <span>{{ $siswa->kelas->nama_kelas ?? '-' }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-chalkboard-teacher text-green-500"></i>
            <span>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-rocket text-purple-500"></i>
            <span>{{ $siswa->rencana->nama_rencana ?? '-' }}</span>
        </div>
    @else
        <span>Data siswa tidak ditemukan</span>
    @endif
</div>
