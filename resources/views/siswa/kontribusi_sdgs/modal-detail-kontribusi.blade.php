<div id="detailModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[9999] flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl overflow-hidden animate-fadeIn">

        <!-- Header -->
        <div class="bg-gradient-to-r from-slate-navy to-blue-900 px-8 py-6 flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-bold text-white">Detail Kontribusi</h3>
                <p class="text-blue-200 text-sm" id="detailTanggal"></p>
            </div>

            <button onclick="closeDetailModal()"
                    class="text-white text-2xl hover:text-blue-200 transition">
                &times;
            </button>
        </div>

        <!-- Body -->
        <div class="px-8 py-6 space-y-6 max-h-[70vh] overflow-y-auto scrollbar-hide">

            <!-- Kategori -->
            <div>
                <h4 class="text-sm font-bold text-slate-navy mb-2">Kategori SDGs</h4>
                <p class="bg-off-white p-4 rounded-xl border border-border-gray text-slate-navy leading-relaxed" id="detailKategori"></p>
            </div>

            <!-- Judul -->
            <div>
                <h4 class="text-sm font-bold text-slate-navy mb-2">Judul Kegiatan</h4>
                <p class="bg-off-white p-4 rounded-xl border border-border-gray text-slate-navy leading-relaxed" id="detailJudul"></p>
            </div>

            <!-- Refleksi -->
            <div>
                <h4 class="text-sm font-bold text-slate-navy mb-2">Refleksi Kegiatan</h4>
                <div class="bg-off-white p-4 rounded-xl border border-border-gray text-slate-navy leading-relaxed" id="detailRefleksi"></div>
            </div>

            <!-- Tanggal Pelaksanaan -->
            <div>
                <h4 class="text-sm font-bold text-slate-navy mb-2">Tanggal Pelaksanaan</h4>
                <p class="bg-off-white p-4 rounded-xl border border-border-gray text-slate-navy leading-relaxed" id="detailTanggalPelaksanaan"></p>
            </div>

            <!-- Bukti Foto -->
            <div>
                <h4 class="text-sm font-bold text-slate-navy mb-3">Bukti Kegiatan</h4>
                <div id="detailBukti" class="flex gap-4 flex-wrap"></div>
            </div>
        </div>
    </div>
</div>
