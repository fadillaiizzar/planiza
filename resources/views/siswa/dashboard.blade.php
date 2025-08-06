@extends('layouts.app')

@section('title', 'Dashboard Siswa - Planiza')

@section('content')
    <!-- Hero Section -->
    <section id="dashboard-siswa" class="bg-off-white text-slate-navy pt-40 sm:pt-44 pb-16 sm:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Heading -->
            <div class="mb-12">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 sm:mb-6 flex flex-wrap justify-center items-center gap-2 sm:gap-3">
                    Hai, <span class="text-slate-navy">{{ $user->name }}</span> 
                    <span class="text-3xl sm:text-4xl">👋</span>
                </h1>
                <p class="text-base sm:text-lg text-cool-gray font-medium">siap belajar dan menjelajahi karier hari ini?</p>
            </div>

            <!-- Quick Access Buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 sm:gap-6 max-w-5xl mx-auto">
                <a href="#" class="bg-off-white border border-border-gray hover:shadow-xl rounded-2xl p-6 sm:p-8 transition-all duration-300 hover:scale-105 hover:-translate-y-2 group">
                    <div class="text-3xl sm:text-4xl mb-3 group-hover:scale-110 transition-transform">📚</div>
                    <h3 class="font-semibold text-slate-navy text-base sm:text-lg">Materi</h3>
                    <p class="text-cool-gray text-sm mt-1">Pembelajaran</p>
                </a>
                <a href="#" class="bg-off-white border border-border-gray hover:shadow-xl rounded-2xl p-6 sm:p-8 transition-all duration-300 hover:scale-105 hover:-translate-y-2 group">
                    <div class="text-3xl sm:text-4xl mb-3 group-hover:scale-110 transition-transform">🔍</div>
                    <h3 class="font-semibold text-slate-navy text-base sm:text-lg">Eksplorasi</h3>
                    <p class="text-cool-gray text-sm mt-1">Jelajahi minat</p>
                </a>
                <a href="#" class="bg-off-white border border-border-gray hover:shadow-xl rounded-2xl p-6 sm:p-8 transition-all duration-300 hover:scale-105 hover:-translate-y-2 group">
                    <div class="text-3xl sm:text-4xl mb-3 group-hover:scale-110 transition-transform">💼</div>
                    <h3 class="font-semibold text-slate-navy text-base sm:text-lg">Kenali Karir</h3>
                    <p class="text-cool-gray text-sm mt-1">Profesi impian</p>
                </a>
                <a href="#" class="bg-off-white border border-border-gray hover:shadow-xl rounded-2xl p-6 sm:p-8 transition-all duration-300 hover:scale-105 hover:-translate-y-2 group">
                    <div class="text-3xl sm:text-4xl mb-3 group-hover:scale-110 transition-transform">🌍</div>
                    <h3 class="font-semibold text-slate-navy text-base sm:text-lg">Kontribusi SDGs</h3>
                    <p class="text-cool-gray text-sm mt-1">Perubahan nyata</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Student Dashboard Statistics -->
    <section class="py-16 bg-off-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
           <h2 class="text-2xl md:text-3xl font-bold text-slate-navy mb-12 text-center">Statistik Siswa</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kenali Karir -->
                <div class="bg-off-white p-6 rounded-lg shadow-sm border border-border-gray text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-bar text-2xl text-blue-600"></i>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-2">0</div>
                    <div class="text-slate-navy mb-2">Kenali Karir</div>
                    <div class="text-sm text-cool-gray">Tes yang telah diselesaikan</div>
                </div>

                <!-- Kontribusi SDGs -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-border-gray text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-globe text-2xl text-green-600"></i>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-2">0</div>
                    <div class="text-slate-navy mb-2">Kontribusi SDGs</div>
                    <div class="text-sm text-cool-gray">Kegiatan yang telah dikontribusikan</div>
                </div>

                <!-- Bincang Karir -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-border-gray text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-comments text-2xl text-purple-600"></i>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-2">0</div>
                    <div class="text-slate-navy mb-2">Bincang Karir</div>
                    <div class="text-sm text-cool-gray">Diskusi yang telah diikuti</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recommendation Section -->
    <section class="py-16 bg-slate-navy text-off-white relative overflow-hidden">
        <div class="absolute inset-0 bg-slate-navy"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">🚀 Saatnya Menemukan Arah Karier Terbaikmu!</h2>
                <p class="text-lg text-gray-300 mb-8 leading-relaxed">
                    Kenali potensi diri dan temukan pilihan profesi atau jurusan yang sesuai denganmu
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="#" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-slate-navy transition-all duration-300 hover:scale-105 inline-flex items-center">
                        <i class="fas fa-play mr-2"></i>
                        Temukan Kariermu
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Popup Pilih Rencana -->
    @if(session('loginSuccess'))
    <div id="popupRencana" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-2">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto max-h-[85vh] overflow-hidden">
            <div class="p-4">
                <!-- Header -->
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
        document.addEventListener("DOMContentLoaded", function () {
            const hamburger = document.getElementById("hamburger-dashboard");
            const mobileMenu = document.getElementById("mobileMenuDashboard");

            hamburger.addEventListener("click", function () {
                mobileMenu.classList.toggle("hidden");
            });
        });

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