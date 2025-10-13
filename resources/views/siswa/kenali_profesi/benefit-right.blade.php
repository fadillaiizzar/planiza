<div class="space-y-8">

    <!-- Header -->
    @include('siswa.components.kenali_karier.header')

    <!-- Features -->
    <div class="space-y-6">
        @php
            $features = [
                [
                    'gradient' => 'from-emerald-400 to-emerald-600',
                    'icon' => '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>',
                    'title' => 'Rekomendasi Profesi Kerja dari Tes',
                    'desc' => 'Dapatkan rekomendasi profesi yang tepat berdasarkan hasil tes kepribadian dan minat Anda',
                    'delay' => 0,
                ],
                [
                    'gradient' => 'from-blue-400 to-blue-600',
                    'icon' => '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>',
                    'title' => 'Informasi Detail Profesi Kerja',
                    'desc' => 'Pelajari detail lengkap setiap profesi termasuk tugas, skill yang dibutuhkan, dan prospek karir',
                    'delay' => 100,
                ],
                [
                    'gradient' => 'from-purple-400 to-purple-600',
                    'icon' => '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>',
                    'title' => 'Rekomendasi Profesi Kerja dari Kontribusi SDGs',
                    'desc' => 'Temukan profesi yang sejalan dengan Sustainable Development Goals dan memberikan dampak positif',
                    'delay' => 200,
                ],
            ];
        @endphp

        @foreach ($features as $feature)
            <x-siswa.kenali_karier.feature
                :icon="$feature['icon']"
                :gradient="$feature['gradient']"
                :title="$feature['title']"
                :desc="$feature['desc']"
                :delay="$feature['delay']"
            />
        @endforeach
    </div>
</div>
