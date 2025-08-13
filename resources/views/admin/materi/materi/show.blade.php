<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Topik Materi - Planiza</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins bg-slate-50">

    <div class="min-h-screen overflow-y-auto py-10 px-4 flex items-center justify-center">
        <div class="w-full max-w-md border border-border py-8 shadow-xl rounded-2xl bg-white">

            <!-- Header -->
            <div class="flex items-center mb-6 px-6">
                <a href="{{ route('admin.topik.materi.index') }}" class="p-2 text-slate-600 hover:text-slate-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-slate-800 ml-2">Detail Topik Materi</h2>
            </div>

            <!-- Detail Content -->
            <div class="px-8 space-y-6 text-slate-700">

                <!-- ID -->
                <div>
                    <label for="id" class="block text-sm font-medium text-slate-700 mb-2">ID</label>
                    <div id="id" class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 text-slate-900 select-none">
                        {{ $topik->id }}
                    </div>
                </div>

                <!-- Judul Topik -->
                <div>
                    <label for="judul_topik" class="block text-sm font-medium text-slate-700 mb-2">Judul Topik</label>
                    <div id="judul_topik" class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 text-slate-900 select-none">
                        {{ $topik->judul_topik }}
                    </div>
                </div>

                <!-- Kelas -->
                <div>
                    <label for="kelas" class="block text-sm font-medium text-slate-700 mb-2">Kelas</label>
                    <div id="kelas"
                         class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 text-slate-900 select-none">
                        {{ $topik->kelas->nama_kelas ?? '-' }}
                    </div>
                </div>

                <!-- Jurusan -->
                <div>
                    <label for="jurusan" class="block text-sm font-medium text-slate-700 mb-2">Jurusan</label>
                    <div id="jurusan"
                         class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 text-slate-900 select-none">
                        {{ $topik->jurusan->nama_jurusan ?? '-' }}
                    </div>
                </div>

                <!-- Rencana -->
                <div>
                    <label for="rencana" class="block text-sm font-medium text-slate-700 mb-2">Rencana</label>
                    <div id="rencana"
                         class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 text-slate-900 select-none">
                        {{ $topik->rencana->nama_rencana ?? '-' }}
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
