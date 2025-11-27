<div id="kontribusiModal" class="hidden fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-3xl w-full max-h-[85vh] shadow-2xl flex flex-col overflow-hidden">
        <!-- Header - Fixed -->
        <div class="bg-gradient-to-r from-slate-navy to-blue-900 px-8 py-6 flex justify-between items-center flex-shrink-0">
            <div>
                <h3 class="text-2xl font-bold text-white">Tambah Kontribusi SDGs</h3>
                <p class="text-blue-200 text-sm mt-1" id="stepIndicator">Step 1 dari 2</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form - Scrollable without scrollbar -->
        <form id="kontribusiForm" action="{{ route('siswa.kontribusi-sdgs.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 overflow-hidden">
            @csrf

            <!-- Content Area - Custom Scrollbar Hidden -->
            <div class="flex-1 overflow-y-auto px-8 py-6 scrollbar-hide">
                <!-- Step 1: Kegiatan -->
                <div id="step1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-slate-navy text-white rounded-xl flex items-center justify-center font-bold">1</div>
                        <h4 class="text-xl font-bold text-slate-navy">Kegiatan</h4>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-navy mb-3">Judul Kegiatan <span class="text-red-500">*</span></label>
                            <input
                                type="text"
                                name="judul_kegiatan"
                                id="judulKegiatan"
                                placeholder="Contoh: Aksi Tanam Pohon di Bantaran Sungai"
                                class="w-full px-5 py-4 border-2 border-border-gray rounded-xl focus:ring-2 focus:ring-slate-navy focus:border-slate-navy transition-all text-slate-navy placeholder-cool-gray"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-navy mb-3">Tanggal Kegiatan <span class="text-red-500">*</span></label>
                            <input
                                type="date"
                                name="tanggal_pelaksanaan"
                                id="tanggalKegiatan"
                                class="w-full px-5 py-4 border-2 border-border-gray rounded-xl focus:ring-2 focus:ring-slate-navy focus:border-slate-navy transition-all text-slate-navy"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-navy mb-3">
                                Durasi Kegiatan <span class="text-red-500">*</span>
                            </label>

                            <div class="flex gap-3">
                                <input
                                    type="number"
                                    name="durasi_nilai"
                                    min="1"
                                    placeholder="Masukkan durasi"
                                    class="w-1/2 px-5 py-4 border-2 border-border-gray rounded-xl
                                        focus:ring-2 focus:ring-slate-navy focus:border-slate-navy
                                        transition-all text-slate-navy placeholder-cool-gray"
                                    required
                                >

                                <select
                                    name="durasi_satuan"
                                    class="w-1/2 px-5 py-4 border-2 border-border-gray rounded-xl
                                        focus:ring-2 focus:ring-slate-navy focus:border-slate-navy
                                        transition-all text-slate-navy"
                                    required
                                >
                                    <option value="menit">Menit</option>
                                    <option value="jam">Jam</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-navy mb-3">
                                Jenis Kegiatan <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="jenis_kegiatan"
                                class="w-full px-5 py-4 border-2 border-border-gray rounded-xl
                                    focus:ring-2 focus:ring-slate-navy focus:border-slate-navy
                                    transition-all text-slate-navy"
                                required
                            >
                                <option value="">-- Pilih Jenis --</option>
                                <option value="individu">Individu</option>
                                <option value="kelompok">Kelompok</option>
                                <option value="event">Event</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-navy mb-3">
                                Peran Dalam Kegiatan <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="peran"
                                class="w-full px-5 py-4 border-2 border-border-gray rounded-xl
                                    focus:ring-2 focus:ring-slate-navy focus:border-slate-navy
                                    transition-all text-slate-navy"
                                required
                            >
                                <option value="">-- Pilih Peran --</option>
                                <option value="peserta">Peserta</option>
                                <option value="panitia">Panitia</option>
                                <option value="ketua">Ketua</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Refleksi -->
                <div id="step2" class="hidden">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-slate-navy text-white rounded-xl flex items-center justify-center font-bold">2</div>
                        <h4 class="text-xl font-bold text-slate-navy">Refleksi</h4>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-navy mb-3">Pilih SDGs Terkait <span class="text-red-500">*</span></label>
                            <select
                                name="kategori_sdgs_id"
                                id="kategoriSdgs"
                                class="w-full px-5 py-4 border-2 border-border-gray rounded-xl focus:ring-2 focus:ring-slate-navy focus:border-slate-navy transition-all text-slate-navy"
                            >
                                <option value="">-- Pilih SDGs --</option>
                                @foreach($kategoriSdgs as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nomor_kategori }}. {{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>

                            <button
                                type="button"
                                onclick="openSDGsGuideModal()"
                                class="mt-3 text-sm text-slate-navy hover:text-blue-600 font-semibold flex items-center gap-2 group"
                            >
                                <span class="group-hover:scale-110 transition-transform">🔗</span>
                                <span class="border-b-2 border-transparent group-hover:border-slate-navy transition-all">Lihat daftar SDGs & contoh kegiatan</span>
                            </button>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-navy mb-3">Refleksi Kegiatan <span class="text-red-500">*</span></label>
                            <textarea
                                name="deskripsi_refleksi"
                                id="deskripsi_refleksi"
                                rows="5"
                                placeholder="Ceritakan pengalaman dan pelajaran yang kamu dapat dari kegiatan ini..."
                                class="w-full px-5 py-4 border-2 border-border-gray rounded-xl focus:ring-2 focus:ring-slate-navy focus:border-slate-navy transition-all resize-none text-slate-navy placeholder-cool-gray"
                            ></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-navy mb-3">
                                Upload Bukti Kegiatan <span class="text-red-500">*</span>
                            </label>

                            <label
                                for="buktiFile"
                                class="border-2 border-dashed border-border-gray rounded-xl p-8 text-center hover:border-slate-navy hover:bg-blue-50 transition-all cursor-pointer block"
                            >
                                <div class="text-5xl mb-3 group-hover:scale-110 transition-transform">📸</div>
                                <p class="text-slate-navy font-semibold mb-1">Klik untuk upload foto</p>
                                <p class="text-cool-gray text-sm">Format: JPG, PNG (Maks. 2MB)</p>
                            </label>

                            <input
                                type="file"
                                id="buktiFile"
                                name="bukti_upload[]"
                                accept="image/*"
                                multiple
                                onchange="showFileName(this)"
                                class="sr-only"
                            >

                            <div id="fileName" class="hidden mt-3 space-y-1"></div>
                        </div>
                    </div>
                </div>
            </div>

           <!-- Footer Buttons - Responsive -->
            <div class="bg-off-white border-t-2 border-border-gray px-8 py-5 flex flex-col sm:flex-row justify-between gap-4 flex-shrink-0">
                <button
                    type="button"
                    id="prevBtn"
                    onclick="prevStep()"
                    class="px-8 py-4 border-2 border-border-gray text-cool-gray rounded-xl font-bold hover:border-slate-navy hover:text-slate-navy hover:bg-white transition-all disabled:opacity-30 disabled:cursor-not-allowed w-full sm:w-auto"
                    disabled
                >
                    ← Sebelumnya
                </button>

                <button
                    type="button"
                    id="nextBtn"
                    onclick="nextStep()"
                    class="px-8 py-4 bg-slate-navy text-white rounded-xl font-bold hover:bg-blue-900 transition-all disabled:opacity-50 disabled:cursor-not-allowed shadow-lg w-full sm:w-auto"
                >
                    Selanjutnya →
                </button>

                <button
                    type="submit"
                    id="submitBtn"
                    class="hidden px-8 py-4 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700 transition-all shadow-lg w-full sm:w-auto"
                >
                    ✓ Submit Kontribusi
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay"
     class="hidden fixed inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center z-[9999]">
    <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col items-center gap-3">
        <div class="w-10 h-10 border-4 border-slate-navy border-t-transparent rounded-full animate-spin"></div>
        <p class="text-slate-navy font-semibold">Mengirim kontribusi...</p>
    </div>
</div>

<!-- Custom Popup -->
<div id="warningPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl px-8 py-6 max-w-sm text-center animate-fadeIn">
        <h3 class="text-xl font-bold text-red-600 mb-3">⚠️ Form Belum Lengkap</h3>
        <p class="text-slate-navy mb-5">Semua kolom wajib diisi sebelum melanjutkan.</p>
        <button onclick="closeWarningPopup()" class="px-6 py-3 bg-slate-navy text-white rounded-xl font-semibold hover:bg-blue-900 transition-all">Oke, Saya Lengkapi</button>
    </div>
</div>
