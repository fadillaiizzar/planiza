@extends('layouts.admin')

@section('title', 'Detail Hasil Tes - Planiza')

@section('content')
<main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6 md:p-8">
    <div class="mb-8 max-w-6xl mx-auto">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('admin.kenali-profesi.hasil-tes.index') }}"
               class="group flex items-center px-4 py-2 rounded-full text-cool-gray hover:text-slate-navy hover:bg-white transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="font-medium">Manajemen Hasil Tes</span>
            </a>

            <svg class="w-4 h-4 text-border-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>

            <div class="flex items-center px-4 py-2 rounded-full bg-slate-navy text-white shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="font-semibold">Daftar Pengguna</span>
            </div>
        </nav>
    </div>

    <!-- Header Card -->
    <div class="max-w-6xl mx-auto mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-border-gray p-6">
            <h2 class="text-xl font-bold text-slate-navy flex items-center">
                <svg class="w-6 h-6 text-slate-navy mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Tes : {{ $tes->nama_tes }}
            </h2>
            <p class="text-cool-gray mt-2">Jumlah Pengguna : {{ $users->count() }}</p>
        </div>
    </div>

    <!-- Table Card -->
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-border-gray overflow-hidden">
            <div class="overflow-x-auto scrollbar-none">
                <table class="w-full text-left text-sm table-auto">
                    <thead class="bg-off-white border-b border-border-gray">
                        <tr>
                            <th class="p-4 font-semibold text-slate-navy">No</th>
                            <th class="p-4 font-semibold text-slate-navy">Nama</th>
                            <th class="p-4 font-semibold text-slate-navy hidden md:table-cell">Kelas</th>
                            <th class="p-4 font-semibold text-slate-navy hidden lg:table-cell">Jumlah Pengerjaan</th>
                            <th class="p-4 font-semibold text-slate-navy text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $i => $user)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors">
                            <td class="p-4 text-slate-navy font-medium">{{ $i + 1 }}</td>
                            <td class="p-4">
                                <div class="font-medium text-slate-700">{{ $user->name }}</div>
                                <div class="md:hidden mt-1 space-y-1 text-xs text-cool-gray">
                                    <div>{{ ($user->siswa->kelas->nama_kelas ?? '-') . ' ' . ($user->siswa->jurusan->nama_jurusan ?? '') }}</div>
                                    <div><span class="font-medium">{{ $user->total_pengerjaan }}</span> pengerjaan</div>
                                </div>
                            </td>
                            <td class="p-4 text-slate-navy hidden md:table-cell">
                                {{ ($user->siswa->kelas->nama_kelas ?? '-') . ' ' . ($user->siswa->jurusan->nama_jurusan ?? '') }}
                            </td>
                            <td class="p-4 text-slate-navy hidden lg:table-cell">
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-off-white text-slate-navy font-medium">
                                    {{ $user->total_pengerjaan }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <button class="btn-detail inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full hover:shadow-md transition"
                                        data-tes="{{ $tes->id }}"
                                        data-user="{{ $user->id }}">
                                    Detail
                                </button>
                            </td>
                        </tr>

                        <!-- Collapse Detail Row -->
                        <tr id="collapse-{{ $user->id }}" class="hidden">
                            <td colspan="5" class="p-4 bg-off-white">
                                <div id="detail-{{ $user->id }}">
                                    <div class="h-4 bg-border-gray rounded w-1/4 mb-4"></div>
                                    <div class="h-32 bg-border-gray rounded"></div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center">
                                <x-empty-state
                                    icon="fas fa-clipboard-list"
                                    message="Belum ada pengguna yang mengerjakan tes ini"
                                />
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', async () => {
            const tesId = btn.dataset.tes;
            const userId = btn.dataset.user;
            const collapse = document.getElementById('collapse-' + userId);
            const detailDiv = document.getElementById('detail-' + userId);

            // Toggle row
            if (!collapse.classList.contains('hidden')) {
                collapse.classList.add('hidden');
                return;
            }

            // Show loading
            detailDiv.innerHTML = `
                <div class="flex items-center justify-center py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-slate-navy"></div>
                    <span class="ml-3 text-cool-gray">Memuat data...</span>
                </div>
            `;

            try {
                const res = await fetch(`/admin/kenali-profesi/hasil-tes/${tesId}/user/${userId}`);
                const data = await res.json();

                let html = `
                    <div class="bg-white rounded-xl border border-border-gray p-6">
                        <h6 class="text-base font-bold text-slate-navy mb-4">Detail Pengerjaan ${data.nama}</h6>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-off-white">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-navy">Pengerjaan ke</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-navy">Tanggal</th>
                                        <th class="px-4 py-3 text-center text-xs font-semibold text-slate-navy">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border-gray">
                                    ${data.riwayat.map(r => `
                                        <tr class="hover:bg-off-white transition-colors duration-150">
                                            <td class="px-4 py-3 text-slate-navy font-medium">${r.ke}</td>
                                            <td class="px-4 py-3 text-cool-gray">${r.tanggal}</td>
                                            <td class="px-4 py-3 text-center">
                                                <a href="/admin/kenali-profesi/hasil-tes/${tesId}/user/${userId}/attempt/${r.ke}"
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-slate-navy rounded-lg hover:bg-opacity-90 transition">
                                                Lihat Attempt
                                                </a>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 text-sm text-cool-gray">Total <span class="font-semibold text-slate-navy">${data.total}</span> pengerjaan</div>
                    </div>
                `;

                detailDiv.innerHTML = html;
                collapse.classList.remove('hidden');
            } catch (err) {
                detailDiv.innerHTML = `<div class="text-center text-red-500">Gagal memuat data</div>`;
                console.error(err);
            }
        });
    });
    </script>
@endpush
