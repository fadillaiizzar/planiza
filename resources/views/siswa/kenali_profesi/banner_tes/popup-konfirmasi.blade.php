<!-- Popup Konfirmasi Data -->
<div id="popupConfirm" class="hidden fixed inset-0 bg-slate-navy/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-fadeIn">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-xl mx-auto max-h-[90vh] flex flex-col overflow-hidden transform animate-slideUp border border-border-gray">

        <!-- Header dengan Gradient -->
        <div class="bg-gradient-to-r from-slate-navy via-cool-gray to-slate-navy p-6 text-white relative overflow-hidden flex-shrink-0">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-sm flex items-center justify-center">
                            <i class="fas fa-brain text-lg text-white"></i>
                        </div>
                        <h2 class="text-xl font-bold">Konfirmasi Data</h2>
                    </div>
                </div>
                <p class="text-off-white/90 text-sm leading-relaxed">
                    Pastikan datamu benar sebelum melanjutkan tes minat dan bakat
                </p>
            </div>
            <!-- Decorative Wave -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-6">
                    <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" fill="rgba(255,255,255,0.1)"></path>
                </svg>
            </div>
        </div>

        <!-- Content Body (Scrollable) -->
        <div class="p-6 space-y-6 flex-1 overflow-y-auto scrollbar-none">
            <!-- Data Diri Card -->
            <div class="group p-5 rounded-2xl bg-gradient-to-r from-off-white to-border-gray border-l-4 border-cool-gray hover:shadow-lg transition-all duration-300">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-cool-gray rounded-xl text-white flex-shrink-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-slate-navy mb-3">Data Diri</h3>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-slate-navy font-medium">
                                <span>Nama : </span>
                                <span class="ml-1">{{ $user->name }}</span>
                            </div>
                            <div class="flex items-center text-sm text-slate-navy font-medium">
                                <span>Kelas : </span>
                                <span class="ml-1">{{ $user->siswa->kelas->nama_kelas ?? '-' }}</span>
                            </div>
                            <div class="flex items-center text-sm text-slate-navy font-medium">
                                <span>Jurusan : </span>
                                <span class="ml-1">{{ $user->siswa->jurusan->nama_jurusan ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pilihan Rekomendasi Card -->
            <div class="group p-5 rounded-2xl bg-gradient-to-r from-off-white to-border-gray border-l-4 border-cool-gray hover:shadow-lg transition-all duration-300">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-cool-gray rounded-xl text-white flex-shrink-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-slate-navy mb-3">Pilihan Rekomendasi</h3>
                        <div class="flex items-center gap-2">
                            <div class="p-1 bg-white rounded-full">
                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-sm text-slate-navy font-medium">Profesi Kerja</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer dengan Action Buttons -->
        <div class="p-6 bg-off-white border-t border-border-gray flex-shrink-0">
            <div class="flex gap-2 justify-center">
                <button id="closePopup"
                    class="px-5 text-slate-600 hover:text-slate-800 font-medium hover:underline">
                    <div class="flex items-center gap-2">
                        <span>Batal</span>
                    </div>
                </button>

                <a href="{{ route('siswa.kenali-profesi.tes.index') }}"
                    class="group px-10 py-3 rounded-xl flex justify-center bg-gradient-to-r from-slate-navy via-cool-gray to-slate-navy text-white font-semibold hover:shadow-xl transition-all duration-300 overflow-hidden relative">

                    <div class="absolute inset-0 bg-gradient-to-r from-cool-gray via-slate-navy to-cool-gray opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative flex items-center gap-2">
                        <span>Lanjutkan</span>
                        <svg class="w-4 h-4 transform group-hover:scale-110 group-hover:translate-x-1 transition-all duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openBtn = document.getElementById('openPopup');
        const closeBtn = document.getElementById('closePopup');
        const popup = document.getElementById('popupConfirm');

        openBtn?.addEventListener('click', () => {
            popup.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });

        closeBtn?.addEventListener('click', () => {
            popup.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    });
</script>
@endpush
