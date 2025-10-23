<div id="popupKeluar" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center animate-slideUp">
        <div class="text-slate-navy mb-3">
            <i class="fa-solid fa-triangle-exclamation text-4xl text-yellow-500 mb-2"></i>
            <h2 class="text-xl font-bold">Yakin Mau Keluar?</h2>
        </div>
        <p class="text-cool-gray text-sm mb-6">
            Kamu akan meninggalkan halaman ini. Lanjutkan keluar?
        </p>
        <div class="flex justify-center gap-3">
            <button id="batalKeluar"
                class="px-5 py-2 rounded-lg bg-cool-gray/10 text-slate-navy font-medium hover:bg-cool-gray/20 transition-all">
                Batal
            </button>
            <a href="{{ route('siswa.kenali-jurusan.index') }}"
                id="konfirmasiKeluar"
                class="px-5 py-2 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition-all">
                Ya, Keluar
            </a>
        </div>
    </div>
</div>
