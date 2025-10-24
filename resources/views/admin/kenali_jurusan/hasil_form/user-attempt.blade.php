<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Planiza')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
    <body class="font-poppins bg-off-white text-slate-navy">
    @foreach ($attempts as $attempt)
    <div class="relative bg-white rounded-2xl p-8 mb-8 overflow-hidden shadow-lg border border-border-gray/30">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-slate-navy via-cool-gray to-slate-navy"></div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-navy to-cool-gray flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-lg">{{ $attempt->attempt }}</span>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-slate-navy tracking-tight">
                        Detail Attempt
                    </h1>
                </div>
            </div>
            <div class="ml-15 space-y-1">
                <p class="text-slate-navy font-medium">{{ $user->name }}</p>
                <p class="text-cool-gray text-sm">Form Kuliah</p>
            </div>

            <div class="mt-4">
                <p>Nilai UTBK: <strong>{{ $attempt->nilai_utbk }}</strong></p>
                <p>Jurusan Kuliah:</p>
                <ul>
                    @foreach ($attempt->minats->pluck('jurusanKuliah')->filter() as $jurusan)
                        <li>{{ $jurusan->nama_jurusan ?? '-' }}</li>
                    @endforeach
                </ul>
                <p>Hobi:</p>
                <ul>
                    @foreach ($attempt->minats->pluck('hobi')->filter() as $hobi)
                        <li>{{ $hobi->nama_hobi ?? '-' }}</li>
                    @endforeach
                </ul>

                <p>Rekomendasi Kampus:</p>
                <ul>
                    @foreach ($attempt->minats->pluck('jurusanKuliah')->filter() as $jurusan)
                        @foreach ($jurusan->kampus as $kampus)
                            <li>{{ $kampus->nama_kampus }} - Passing Grade: {{ $kampus->pivot->passing_grade ?? '-' }}</li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    </body>
</html>
