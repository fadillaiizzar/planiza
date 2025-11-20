@extends('layouts.admin')

@section('title', 'Detail Kontribusi SDGs - Planiza')

@section('content')
<main class="flex-1 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6 md:p-8">

    <!-- Breadcrumb -->
    <div class="mb-8 max-w-5xl mx-auto">
        <nav class="flex items-center space-x-2 text-sm">

            <a href="{{ route('admin.sdgs.kontribusi-sdgs.index') }}"
               class="group flex items-center px-4 py-2 rounded-full text-slate-400 hover:text-slate-600 hover:bg-white/70 transition-all">
                <i class="fas fa-list w-4 h-4 mr-2 text-slate-300 group-hover:text-slate-500"></i>
                <span class="font-medium">Kontribusi SDGs</span>
            </a>

            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>

            <div class="flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-slate-600 to-slate-700 text-white shadow-md">
                <i class="fas fa-file-alt w-4 h-4 mr-2"></i>
                <span class="font-semibold">Detail Kontribusi</span>
            </div>
        </nav>
    </div>

    <!-- Card -->
    <div class="w-full max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">

        <!-- Header -->
        <div class="bg-gradient-to-r from-slate-600 to-slate-700 px-8 py-6">
            <h2 class="text-xl font-bold text-white">Detail Kontribusi SDGs</h2>
            <p class="text-slate-200 text-sm">Informasi lengkap kontribusi siswa</p>
        </div>

        <!-- Content -->
        <div class="px-8 pt-8 pb-4 space-y-6">

            <!-- Nama -->
            <div>
                <label class="font-semibold text-sm text-slate-700 mb-2 flex items-center">
                    <i class="fas fa-user mr-2 text-blue-500"></i> Nama Siswa
                </label>
                <div class="p-4 bg-white border rounded-2xl shadow-sm">
                    {{ $item->user?->name }}
                </div>
            </div>

            <!-- Kelas -->
            <div>
                <label class="font-semibold text-sm text-slate-700 mb-2 flex items-center">
                    <i class="fas fa-school mr-2 text-indigo-500"></i> Kelas
                </label>
                <div class="p-4 bg-white border rounded-2xl shadow-sm">
                    {{ trim(($item->user?->siswa?->kelas?->nama_kelas ?? '') . ' ' . ($item->user?->siswa?->jurusan?->nama_jurusan ?? '')) ?: '' }}
                </div>
            </div>

            <!-- Judul Kegiatan -->
            <div>
                <label class="font-semibold text-sm text-slate-700 mb-2 flex items-center">
                    <i class="fas fa-book mr-2 text-green-500"></i> Judul Kegiatan
                </label>
                <div class="p-4 bg-white border rounded-2xl shadow-sm">
                    {{ $item->judul_kegiatan }}
                </div>
            </div>

            <!-- Kategori SDGs -->
            <div>
                <label class="font-semibold text-sm text-slate-700 mb-2 flex items-center">
                    <i class="fas fa-globe-asia mr-2 text-orange-500"></i> Kategori SDGs
                </label>
                <div class="p-4 bg-white border rounded-2xl shadow-sm">
                    {{ $item->kategoriSdgs?->nama_kategori }}
                </div>
            </div>

            <!-- Deskripsi Refleksi -->
            <div>
                <label class="font-semibold text-sm text-slate-700 mb-2 flex items-center">
                   <i class="fas fa-quote-left mr-2 text-amber-600"></i> Deskripsi Refleksi
                </label>
                <div class="p-4 bg-white border rounded-2xl shadow-sm">
                    {{ $item->deskripsi_refleksi }}
                </div>
            </div>

            <!-- Tanggal -->
            <div>
                <label class="font-semibold text-sm text-slate-700 mb-2 flex items-center">
                    <i class="fas fa-calendar-alt mr-2 text-purple-500"></i> Tanggal Pelaksanaan
                </label>
                <div class="p-4 bg-white border rounded-2xl shadow-sm">
                    {{ $item->tanggal_pelaksanaan }}
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="font-semibold text-sm text-slate-700 mb-3 flex items-center">
                    <i class="fas fa-flag mr-2 text-red-500"></i> Status Kontribusi
                </label>

                <form action="{{ route('admin.sdgs.kontribusi-sdgs.update-status', $item->id) }}" method="POST">
                    @csrf
                    <select name="status" class="w-full p-4 border rounded-2xl shadow-sm bg-white">
                        <option value="pending"  {{ $item->status=='pending' ? 'selected':'' }}>Pending</option>
                        <option value="approved" {{ $item->status=='approved' ? 'selected':'' }}>Approved</option>
                        <option value="rejected" {{ $item->status=='rejected' ? 'selected':'' }}>Rejected</option>
                    </select>

                    <button type="submit"
                        class="mt-4 px-6 py-3 bg-slate-navy text-white rounded-2xl shadow font-semibold">
                        Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-8 py-5 bg-slate-50 border-t text-sm text-slate-500 flex justify-between">
            <span><i class="fas fa-clock mr-1"></i> Terakhir diperbarui: {{ $item->updated_at->format('d M Y, H:i') }}</span>
        </div>

    </div>
</main>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
