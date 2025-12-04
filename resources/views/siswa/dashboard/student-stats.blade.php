<section class="py-16 bg-off-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-navy mb-12 text-center">Statistik Siswa</h2>

        @php
            $kenaliProfesi = $user->kenaliProfesis()->distinct('attempt')->count('attempt');
            $kenaliJurusan = $user->kenaliJurusans()->distinct('attempt')->count('attempt');
            $totalKenaliKarir = $kenaliProfesi + $kenaliJurusan;

            $totalKontribusi = $user->kontribusiSdgs()->count() ?? 0;

            $stats = [
                [
                    'icon' => 'fas fa-chart-bar',
                    'colorIcon' => 'text-blue-600',
                    'bgColor' => 'bg-blue-100',
                    'number' => $totalKenaliKarir,
                    'title' => 'Kenali Karir',
                    'desc' => 'Tes yang telah diselesaikan',
                ],
                [
                    'icon' => 'fas fa-tools',
                    'colorIcon' => 'text-green-600',
                    'bgColor' => 'bg-green-100',
                    'number' => $totalKontribusi,
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
