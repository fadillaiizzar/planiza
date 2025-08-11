@extends('layouts.admin')

@section('title', 'Manajemen Materi - Planiza')

@section('content')
    <!-- Overlay (mobile) -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main -->
    <main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6">
        <div class="flex justify-center mb-8 gap-4 flex-wrap">
            <button id="btnTopik"
                class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300
                    bg-gradient-to-r from-slate-navy to-cool-gray text-off-white
                    hover:scale-105 hover:from-cool-gray hover:to-slate-navy
                    focus:ring-4 focus:ring-cool-gray">
                📚 Topik Materi
            </button>

            <button id="btnMateri"
                class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300
                    bg-off-white text-slate-navy border border-border-gray
                    hover:bg-cool-gray hover:text-off-white hover:scale-105
                    focus:ring-4 focus:ring-border-gray">
                📄 Materi
            </button>
        </div>

        <div id="sectionTopik" class="mx-auto max-w-7xl space-y-6">
            @include('admin.components.header.header', [
                'pageTitle' => 'Topik Materi Management',
                'addButtonText' => 'Tambah Topik',
                'addUserRoute' => route('admin.materi.create'),
                'userCount' => $userCount,
                'stats' => [
                    ['label' => 'Total Topik', 'count' => $materiCount, 'icon' => 'fas fa-book', 'bg' => 'from-blue-500 to-blue-600', 'textColor' => 'text-blue-100'],
                    ['label' => 'Topik per Kelas', 'count' => $materiPerKelas->sum(), 'icon' => 'fas fa-layer-group', 'bg' => 'from-green-500 to-green-600', 'textColor' => 'text-green-100'],
                    ['label' => 'Topik per Jurusan', 'count' => $materiPerJurusan->sum(), 'icon' => 'fas fa-university', 'bg' => 'from-purple-500 to-purple-600', 'textColor' => 'text-purple-100'],
                ],
                'roles' => [] // tidak dipakai di halaman ini
            ])

            <!-- Statistik Topik -->
            <section class="bg-off-white rounded-2xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-slate-navy mb-6">Statistik Topik</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Topik per Kelas -->
                    <div class="bg-white rounded-xl border border-border-gray shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
                        <h4 class="text-lg font-semibold text-slate-navy mb-4">📚 Topik per Kelas</h4>
                        <ul class="space-y-2 text-cool-gray">
                            @foreach($materiPerKelas as $kelas => $count)
                                <li class="flex justify-between items-center border-b border-border-gray pb-1 last:border-none last:pb-0">
                                    <span>{{ $kelas }}</span>
                                    <strong class="text-slate-navy">{{ $count }}</strong>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Topik per Jurusan -->
                    <div class="bg-white rounded-xl border border-border-gray shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
                        <h4 class="text-lg font-semibold text-slate-navy mb-4">🏫 Topik per Jurusan</h4>
                        <ul class="space-y-2 text-cool-gray">
                            @foreach($materiPerJurusan as $jurusan => $count)
                                <li class="flex justify-between items-center border-b border-border-gray pb-1 last:border-none last:pb-0">
                                    <span>{{ $jurusan }}</span>
                                    <strong class="text-slate-navy">{{ $count }}</strong>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </section>

            <!-- Daftar Topik Materi -->
           <section class="bg-white rounded-xl shadow p-6 mt-6">
                <h3 class="text-xl font-bold mb-6 text-slate-navy">📚 Daftar Topik Materi</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm table-auto">
                        <thead class="bg-off-white border-b border-border-gray">
                            <tr>
                                <th class="p-4 font-semibold text-slate-navy">ID</th>
                                <th class="p-4 font-semibold text-slate-navy">Judul Topik</th>
                                <th class="p-4 font-semibold text-slate-navy">Kelas</th>
                                <th class="p-4 font-semibold text-slate-navy">Jurusan</th>
                                <th class="p-4 font-semibold text-slate-navy">Rencana</th>
                                <th class="p-4 font-semibold text-slate-navy ">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topikMateris as $topik)
                            <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors">
                                <td class="p-4">{{ $topik->id }}</td>
                                <td class="p-4 font-medium text-slate-navy">{{ $topik->judul_topik }}</td>
                                <td class="p-4">{{ $topik->kelas->nama_kelas ?? '-' }}</td>
                                <td class="p-4">{{ $topik->jurusan->nama_jurusan ?? '-' }}</td>
                                <td class="p-4">{{ $topik->rencana->nama_rencana ?? '-' }}</td>

                                <!-- Dropdown Aksi -->
                                <td class="p-4 relative overflow-visible">
                                    <button onclick="toggleDropdown({{ $topik->id }})"
                                        class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                        <i class="fas fa-cog text-cool-gray"></i>
                                    </button>

                                    <div id="dropdown-{{ $topik->id }}"
                                        class="hidden absolute right-20 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">

                                        <a href="{{ route('admin.materi.show', $topik->id) }}"
                                            class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                            <i class="fas fa-eye w-5 h-5"></i>
                                            <span>Detail</span>
                                        </a>

                                        <a href="{{ route('admin.materi.edit', $topik->id) }}"
                                            class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base">
                                            <i class="fas fa-edit w-5 h-5"></i>
                                            <span>Edit</span>
                                        </a>

                                        <div class="border-t border-border-gray"></div>

                                        <form action="{{ route('admin.materi.destroy', $topik->id) }}" method="POST" onsubmit="return confirm('Yakin hapus topik materi ini?')" class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base border-none bg-transparent cursor-pointer">
                                                <i class="fas fa-trash-alt w-5 h-5"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div id="sectionMateri" class="mx-auto max-w-7xl space-y-6 hidden">
            @include('admin.components.header.header', [
                'pageTitle' => 'Materi Management',
                'addButtonText' => 'Tambah Materi',
                'addUserRoute' => route('admin.materi.create'),
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
                <h3 class="text-xl font-bold mb-6 text-slate-navy">📚 Daftar Topik Materi</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm table-auto">
                        <thead class="bg-off-white border-b border-border-gray">
                            <tr>
                                <th class="p-4 font-semibold text-slate-navy">ID</th>
                                <th class="p-4 font-semibold text-slate-navy">Judul Topik</th>
                                <th class="p-4 font-semibold text-slate-navy">Kelas</th>
                                <th class="p-4 font-semibold text-slate-navy">Jurusan</th>
                                <th class="p-4 font-semibold text-slate-navy">Rencana</th>
                                <th class="p-4 font-semibold text-slate-navy text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topikMateris as $topik)
                            <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors">
                                <td class="p-4">{{ $topik->id }}</td>
                                <td class="p-4 font-medium text-slate-navy">{{ $topik->judul_topik }}</td>
                                <td class="p-4">{{ $topik->kelas->nama_kelas ?? '-' }}</td>
                                <td class="p-4">{{ $topik->jurusan->nama_jurusan ?? '-' }}</td>
                                <td class="p-4">{{ $topik->rencana->nama_rencana ?? '-' }}</td>

                                <!-- Dropdown Aksi -->
                                <td class="p-4 text-center relative overflow-visible">
                                    <button onclick="toggleDropdown({{ $topik->id }})"
                                        class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                        <i class="fas fa-cog text-cool-gray"></i>
                                    </button>

                                    <div id="dropdown-{{ $topik->id }}"
                                        class="hidden absolute right-8 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">

                                        <a href="{{ route('admin.materi.show', $topik->id) }}"
                                            class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                            <i class="fas fa-eye w-5 h-5"></i>
                                            <span>Detail</span>
                                        </a>

                                        <a href="{{ route('admin.materi.edit', $topik->id) }}"
                                            class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base">
                                            <i class="fas fa-edit w-5 h-5"></i>
                                            <span>Edit</span>
                                        </a>

                                        <div class="border-t border-border-gray"></div>

                                        <form action="{{ route('admin.materi.destroy', $topik->id) }}" method="POST" onsubmit="return confirm('Yakin hapus topik materi ini?')" class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base border-none bg-transparent cursor-pointer">
                                                <i class="fas fa-trash-alt w-5 h-5"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
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
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const btnTopik = document.getElementById('btnTopik');
        const btnMateri = document.getElementById('btnMateri');
        const sectionTopik = document.getElementById('sectionTopik');
        const sectionMateri = document.getElementById('sectionMateri');

        btnTopik.addEventListener('click', () => {
            sectionTopik.classList.remove('hidden');
            sectionMateri.classList.add('hidden');
            btnTopik.classList.add('bg-blue-600', 'text-white');
            btnTopik.classList.remove('bg-gray-200', 'text-gray-700');
            btnMateri.classList.remove('bg-blue-600', 'text-white');
            btnMateri.classList.add('bg-gray-200', 'text-gray-700');
        });

        btnMateri.addEventListener('click', () => {
            sectionMateri.classList.remove('hidden');
            sectionTopik.classList.add('hidden');
            btnMateri.classList.add('bg-blue-600', 'text-white');
            btnMateri.classList.remove('bg-gray-200', 'text-gray-700');
            btnTopik.classList.remove('bg-blue-600', 'text-white');
            btnTopik.classList.add('bg-gray-200', 'text-gray-700');
        });

        btnTopik.addEventListener('click', () => {
            sectionTopik.classList.remove('hidden');
            sectionMateri.classList.add('hidden');

            btnTopik.className = "px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-gradient-to-r from-slate-navy to-cool-gray text-off-white hover:scale-105 hover:from-cool-gray hover:to-slate-navy focus:ring-4 focus:ring-cool-gray";
            btnMateri.className = "px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-off-white text-slate-navy border border-border-gray hover:bg-cool-gray hover:text-off-white hover:scale-105 focus:ring-4 focus:ring-border-gray";
        });

        btnMateri.addEventListener('click', () => {
            sectionMateri.classList.remove('hidden');
            sectionTopik.classList.add('hidden');

            btnMateri.className = "px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-gradient-to-r from-slate-navy to-cool-gray text-off-white hover:scale-105 hover:from-cool-gray hover:to-slate-navy focus:ring-4 focus:ring-cool-gray";
            btnTopik.className = "px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 bg-off-white text-slate-navy border border-border-gray hover:bg-cool-gray hover:text-off-white hover:scale-105 focus:ring-4 focus:ring-border-gray";
        });

        function toggleDropdown(id) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(drop => {
                if (drop.id === `dropdown-${id}`) {
                    drop.classList.toggle('hidden');
                } else {
                    drop.classList.add('hidden');
                }
            });
        }
    </script>
@endpush
