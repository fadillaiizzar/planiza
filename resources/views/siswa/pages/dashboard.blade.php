@extends('layouts.siswa')

@section('title', 'Dashboard Siswa - Planiza')

@section('content')
    <section id="dashboard-siswa" class="bg-off-white text-slate-navy pt-40 sm:pt-44 pb-16 sm:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            @include('siswa.dashboard.heading', ['user' => $user])

            <!-- Quick Access Buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 sm:gap-6 max-w-5xl mx-auto">
                @php
                    $rencanaSiswa = $user->siswa->rencana?->nama_rencana ?? null;

                    $menus = [
                        [
                            'href' => route('siswa.materi.index'),
                            'icon' => 'fas fa-book',
                            'title' => 'Materi',
                            'desc' => 'Pembelajaran materi',
                        ],
                        [
                            'href' => $rencanaSiswa === 'Kerja'
                                        ? route('siswa.eksplorasi-profesi.index')
                                        : ($rencanaSiswa === 'Kuliah'
                                            ? route('siswa.eksplorasi-jurusan.index')
                                            : route('siswa.eksplorasi-profesi.index')),
                            'icon' => 'fas fa-search',
                            'title' => 'Eksplorasi Karier',
                            'desc' => $rencanaSiswa === 'Kerja' ? 'Jelajahi profesi'
                                    : ($rencanaSiswa === 'Kuliah' ? 'Jelajahi jurusan' : 'Jelajahi jurusan'),
                        ],
                        [
                            'href' => $rencanaSiswa === 'Kerja'
                                ? route('siswa.kenali-profesi.index')
                                : ($rencanaSiswa === 'Kuliah'
                                    ? route('siswa.kenali-jurusan.index')
                                    : route('siswa.kenali-profesi.index')),

                            'icon' => $rencanaSiswa === 'Kerja'
                                ? 'fas fa-briefcase'
                                : ($rencanaSiswa === 'Kuliah'
                                    ? 'fas fa-graduation-cap'
                                    : 'fas fa-compass'),

                            'title' => 'Kenali Karier',

                            'desc' => $rencanaSiswa === 'Kerja'
                                ? 'Temukan profesi'
                                : ($rencanaSiswa === 'Kuliah'
                                    ? 'Temukan kampus jurusan'
                                    : 'Temukan arah masa depan mu'),
                        ],
                        [
                            'href' => '#',
                            'icon' => 'fas fa-globe',
                            'title' => 'Kontribusi SDGs',
                            'desc' => 'Perubahan nyata',
                        ],
                    ];
                @endphp

                @foreach ($menus as $menu)
                    <x-siswa.dashboard.quick-acces
                        :href="$menu['href']"
                        :icon="$menu['icon']"
                        :title="$menu['title']"
                        :desc="$menu['desc']"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 bg-off-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-navy mb-12 text-center">Statistik Siswa</h2>

            @php
                $stats = [
                    [
                        'icon' => 'fas fa-chart-bar',
                        'colorIcon' => 'text-blue-600',
                        'bgColor' => 'bg-blue-100',
                        'number' => 0,
                        'title' => 'Kenali Karir',
                        'desc' => 'Tes yang telah diselesaikan',
                    ],
                    [
                        'icon' => 'fas fa-tools',
                        'colorIcon' => 'text-green-600',
                        'bgColor' => 'bg-green-100',
                        'number' => 0,
                        'title' => 'Kontribusi SDGs',
                        'desc' => 'Kegiatan yang telah dikontribusikan',
                    ],
                    [
                        'icon' => 'fas fa-comments',
                        'colorIcon' => 'text-purple-600',
                        'bgColor' => 'bg-purple-100',
                        'number' => 0,
                        'title' => 'Bincang Karir',
                        'desc' => 'Diskusi yang telah diikuti',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($stats as $stat)
                    <x-siswa.dashboard.statistic-card
                        :icon="$stat['icon']"
                        :colorIcon="$stat['colorIcon']"
                        :bgColor="$stat['bgColor']"
                        :number="$stat['number']"
                        :title="$stat['title']"
                        :desc="$stat['desc']"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 bg-slate-navy text-off-white relative overflow-hidden">
        <div class="absolute inset-0 bg-slate-navy"></div>

        @include('siswa.dashboard.hero-profesi')
    </section>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    @if(session('loginSuccess'))
        <div id="popupRencana" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-2">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto max-h-[85vh] overflow-hidden">
                <div class="p-4">
                    <div class="text-center mb-2">
                        <h2 class="text-lg font-bold text-slate-navy">🎯 Pilih Rencanamu Setelah Lulus</h2>
                    </div>

                    <form id="rencanaForm" method="POST" action="{{ route('siswa.simpan.rencana') }}" class="space-y-3 overflow-auto max-h-[70vh] pr-1">
                        @csrf

                        <!-- Nama -->
                        <div>
                            <label class="text-xs font-medium text-cool-gray mb-0.5 block">Nama</label>
                            <input type="text" name="name" value="{{ $user->name }}"
                                class="w-full px-3 py-1.5 border border-gray-200 rounded-md text-sm bg-gray-100"
                                @if($user->role->nama_role === 'Siswa') readonly @endif>
                        </div>

                        <!-- Kelas & Jurusan -->
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="text-xs font-medium text-cool-gray mb-0.5 block">Kelas</label>
                                <input type="text" name="kelas" value="{{ $user->siswa->kelas->nama_kelas ?? '-' }}"
                                    class="w-full px-3 py-1.5 border border-gray-200 rounded-md text-sm bg-gray-100"
                                    readonly>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-cool-gray mb-0.5 block">Jurusan</label>
                                <input type="text" name="jurusan" value="{{ $user->siswa->jurusan->nama_jurusan ?? '-' }}"
                                    class="w-full px-3 py-1.5 border border-gray-200 rounded-md text-sm bg-gray-100"
                                    readonly>
                            </div>
                        </div>

                        <!-- No HP -->
                        <div>
                            <label class="text-xs font-medium text-cool-gray mb-0.5 block">No HP <span class="text-red-500">*</span></label>
                            <input type="tel" name="no_hp" required
                                value="{{ $user->siswa->no_hp ?? '' }}"
                                class="w-full px-3 py-1.5 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500"
                                placeholder="08xxxxxxxxxx">
                        </div>

                        <!-- Rencana -->
                        <div>
                            <label class="text-xs font-medium text-cool-gray mb-0.5 block">Rencana Setelah Lulus <span class="text-red-500">*</span></label>
                            <select name="rencana" required
                                class="w-full px-3 py-1.5 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih rencana setelah lulus</option>
                                <option value="kerja" @if($user->siswa->rencana?->nama_rencana === 'kerja') selected @endif>💼 Kerja</option>
                                <option value="kuliah" @if($user->siswa->rencana?->nama_rencana === 'kuliah') selected @endif>🎓 Kuliah</option>
                            </select>
                        </div>

                        <!-- Tombol -->
                        <button type="submit" id="submitBtn" disabled
                            class="w-full bg-gray-300 text-gray-500 font-semibold py-2 rounded-md cursor-not-allowed transition-colors duration-200">
                            Simpan Rencana
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <section class="bg-off-white h-20"></section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const noHpInput = document.querySelector('input[name="no_hp"]');
            const rencanaSelect = document.querySelector('select[name="rencana"]');
            const submitBtn = document.getElementById('submitBtn');

            function validateForm() {
                if (!noHpInput || !rencanaSelect || !submitBtn) return;

                const noHpValid = noHpInput.value.trim().length >= 10;
                const rencanaValid = rencanaSelect.value.trim().length > 0;

                if (noHpValid && rencanaValid) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                    submitBtn.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700', 'cursor-pointer');
                } else {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                    submitBtn.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700', 'cursor-pointer');
                }
            }

            if (noHpInput) {
                noHpInput.addEventListener('input', validateForm);
            }
            if (rencanaSelect) {
                rencanaSelect.addEventListener('change', validateForm);
            }

            validateForm();
        });
    </script>
@endpush
