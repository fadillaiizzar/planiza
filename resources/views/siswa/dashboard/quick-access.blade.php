<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-5 md:gap-6 max-w-7xl mx-auto">
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
                'href' => route('siswa.kontribusi-sdgs.index'),
                'icon' => 'fas fa-globe',
                'title' => 'Kontribusi SDGs',
                'desc' => 'Perubahan nyata',
            ],
            [
                'href' => route('siswa.bincang-karier.index'),
                'icon' => 'fas fa-comments',
                'title' => 'Bincang Karier',
                'desc' => 'Diskusi dan tanggapan',
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
