<div id="kontribusiModal" class="hidden fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-3xl w-full max-h-[85vh] shadow-2xl flex flex-col overflow-hidden">
        <!-- Header - Fixed -->
        <div class="bg-gradient-to-r from-slate-navy to-blue-900 px-8 py-6 flex justify-between items-center flex-shrink-0">
            <div>
                <h3 class="text-2xl font-bold text-white">Tambah Kontribusi SDGs</h3>
                <p class="text-blue-200 text-sm mt-1" id="stepIndicator">Step 1 dari 2</p>
            </div>
            <button onclick="closeKontribusiModal()" class="text-white hover:text-blue-200 text-3xl font-light transition-colors">×</button>
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
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-navy mb-3">Tanggal Kegiatan <span class="text-red-500">*</span></label>
                            <input
                                type="date"
                                name="tanggal_pelaksanaan"
                                id="tanggalKegiatan"
                                class="w-full px-5 py-4 border-2 border-border-gray rounded-xl focus:ring-2 focus:ring-slate-navy focus:border-slate-navy transition-all text-slate-navy"
                                required
                            >
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
                                required
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
                                required
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
                                required
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

<script>
let selectedFiles = [];

function showFileName(input) {
    const fileList = document.getElementById('fileName');
    const files = Array.from(input.files);

    // Gabungkan file baru ke list lama tanpa duplikat nama
    files.forEach(file => {
        if (!selectedFiles.some(f => f.name === file.name)) {
            selectedFiles.push(file);
        }
    });

    fileList.innerHTML = '';
    fileList.classList.remove("hidden");

    // Tampilkan semua file yg sudah dipilih
    selectedFiles.forEach((file, index) => {
        const fileItem = document.createElement("div");
        fileItem.className = "flex items-center justify-between bg-gray-50 px-4 py-2 rounded-xl border border-border-gray";

        // preview gambar kecil
        const reader = new FileReader();
        reader.onload = e => {
            fileItem.innerHTML = `
                <div class="flex items-center gap-3">
                    <img src="${e.target.result}" class="w-12 h-12 rounded-lg object-cover border">
                    <div>
                        <p class="text-sm font-semibold text-slate-navy">${file.name}</p>
                        <p class="text-xs text-cool-gray">${(file.size / 1024).toFixed(1)} KB</p>
                    </div>
                </div>
                <button type="button" onclick="removeFile(${index})" class="text-red-500 hover:text-red-700 font-bold">✕</button>
            `;
            fileList.appendChild(fileItem);
        };
        reader.readAsDataURL(file);
    });
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    showFileName({ files: [] }); // render ulang daftar
}

// Saat submit, masukkan file2 ke FormData manual
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("kontribusiForm");

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        if (selectedFiles.length === 0) {
            alert("📸 Bukti kegiatan wajib diupload sebelum mengirim!");
            return;
        }

        document.getElementById("loadingOverlay").classList.remove("hidden");

        const formData = new FormData(form);
        formData.delete("bukti_upload[]");
        selectedFiles.forEach(file => formData.append("bukti_upload[]", file));

        try {
            const response = await fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                }
            });

            document.getElementById("loadingOverlay").classList.add("hidden");

            if (response.ok) {
                console.log("✅ Kontribusi berhasil dikirim!");
                selectedFiles = [];
                document.getElementById("fileName").classList.add("hidden");
                form.reset();
                window.location.reload();
            } else {
                console.error("❌ Gagal mengirim data:", await response.text());
            }
        } catch (error) {
            document.getElementById("loadingOverlay").classList.add("hidden");
            console.error("⚠️ Error:", error);
        }
    });
});
</script>
