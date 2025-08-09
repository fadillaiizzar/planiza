@extends('layouts.admin')

@section('title', 'Manajemen Materi - Planiza')

@section('content')
<main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
    <div class="mx-auto max-w-7xl space-y-6">

        @include('admin.components.header.header', [
            'pageTitle' => 'Manajemen Materi',
            'addButtonText' => 'Tambah Materi',
            'addUserRoute' => route('topik-materi.create'),
            'userCount' => $userCount,
            'stats' => [
                ['label' => 'Total Materi', 'count' => $materiCount, 'icon' => 'fas fa-book', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                ['label' => 'Materi per Kelas', 'count' => $materiPerKelas->sum(), 'icon' => 'fas fa-layer-group', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                ['label' => 'Materi per Jurusan', 'count' => $materiPerJurusan->sum(), 'icon' => 'fas fa-university', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
            ],
            'roles' => [] // tidak dipakai di halaman ini
        ])

        <!-- Statistik detail per kelas -->
        <section class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Materi per Kelas</h3>
            <ul>
                @foreach($materiPerKelas as $kelas => $count)
                    <li class="mb-1">{{ $kelas }} : <strong>{{ $count }}</strong> materi</li>
                @endforeach
            </ul>
        </section>

        <!-- Statistik detail per jurusan -->
        <section class="bg-white rounded-xl shadow p-6 mt-6">
            <h3 class="text-lg font-semibold mb-4">Materi per Jurusan</h3>
            <ul>
                @foreach($materiPerJurusan as $jurusan => $count)
                    <li class="mb-1">{{ $jurusan }} : <strong>{{ $count }}</strong> materi</li>
                @endforeach
            </ul>
        </section>

        <!-- Daftar Topik Materi -->
        <section class="bg-white rounded-xl shadow p-6 mt-6">
            <h3 class="text-xl font-semibold mb-4">Daftar Topik Materi</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm table-auto">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="p-4 font-semibold text-slate-700">ID</th>
                            <th class="p-4 font-semibold text-slate-700">Judul Topik</th>
                            <th class="p-4 font-semibold text-slate-700">Kelas</th>
                            <th class="p-4 font-semibold text-slate-700">Jurusan</th>
                            <th class="p-4 font-semibold text-slate-700">Rencana</th>
                            <th class="p-4 font-semibold text-slate-700 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topikMateris as $topik)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                            <td class="p-4">{{ $topik->id }}</td>
                            <td class="p-4 font-medium">{{ $topik->judul_topik }}</td>
                            <td class="p-4">{{ $topik->kelas->nama_kelas ?? '-' }}</td>
                            <td class="p-4">{{ $topik->jurusan->nama_jurusan ?? '-' }}</td>
                            <td class="p-4">{{ $topik->rencana->nama_rencana ?? '-' }}</td>
                            <td class="p-4 text-center space-x-2">
                                <a href="{{ route('topik-materi.show', $topik->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('topik-materi.edit', $topik->id) }}" class="text-green-600 hover:underline">Edit</a>
                                <form action="{{ route('topik-materi.destroy', $topik->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus topik materi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</main>
@endsection

@push('scripts')
<script>
    // Sidebar toggle dan fungsi lain jika ada (sama seperti sebelumnya)
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const isOpen = sidebar.classList.contains('-translate-x-full');
        if (isOpen) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    }
</script>
@endpush
