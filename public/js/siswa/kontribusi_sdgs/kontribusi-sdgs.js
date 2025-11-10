/* ==========================================================
   🟦 1. DETAIL SDG MODAL (Lihat Penjelasan SDGs)
   ========================================================== */
function showSDGDetail(id) {
    const sdg = sdgsData.find(s => s.id === id);
    if (sdg) {
        document.getElementById('sdgDetailNumber').textContent = sdg.nomor_kategori;
        document.getElementById('sdgDetailTitle').textContent = sdg.nama_kategori;
        document.getElementById('sdgDetailDesc').textContent = sdg.deskripsi;
        document.getElementById('sdgDetailModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

function closeSDGDetail() {
    document.getElementById('sdgDetailModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

/* ==========================================================
   🟩 2. KONTRIBUSI MODAL (Step Form Tambah Kontribusi)
   ========================================================== */
let currentStep = 1;
let selectedFiles = [];

function openKontribusiModal() {
    document.getElementById('kontribusiModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    currentStep = 1;
    showStep(1);
}

function closeKontribusiModal() {
    document.getElementById('kontribusiModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    document.getElementById('kontribusiForm').reset();
    document.getElementById('fileName').classList.add('hidden');
    selectedFiles = [];
}

function showStep(step) {
    currentStep = step;
    saveFormData();

    document.getElementById('step1').classList.toggle('hidden', step !== 1);
    document.getElementById('step2').classList.toggle('hidden', step !== 2);
    document.getElementById('prevBtn').disabled = step === 1;
    document.getElementById('nextBtn').classList.toggle('hidden', step === 2);
    document.getElementById('submitBtn').classList.toggle('hidden', step === 1);
    document.getElementById('stepIndicator').textContent = `Step ${step} dari 2`;
}

function validateForm(step) {
    let inputs = [];
    if (step === 1) {
        inputs = [document.getElementById('judulKegiatan'), document.getElementById('tanggalKegiatan')];
    } else if (step === 2) {
        inputs = [document.getElementById('kategoriSdgs'), document.getElementById('deskripsi_refleksi')];
    }

    // Cek input kosong
    for (const input of inputs) {
        if (!input.value || input.value.trim() === "") {
            return false;
        }
    }

    // Step 2: cek file upload wajib
    if (step === 2 && selectedFiles.length === 0) return false;

    return true;
}

function nextStep() {
    if (!validateForm(currentStep)) {
        showWarningPopup();
        return;
    }
    if (currentStep < 2) {
        currentStep++;
        showStep(currentStep);
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

function showFileName(input) {
    const files = Array.from(input.files);

    files.forEach(file => {
        if (!selectedFiles.some(f => f.name === file.name)) {
            selectedFiles.push(file);
        }
    });

    renderFileList();
    saveFormData();
}

function renderFileList() {
    const fileList = document.getElementById('fileName');
    fileList.innerHTML = '';
    if (selectedFiles.length === 0) {
        fileList.classList.add("hidden");
        return;
    }

    fileList.classList.remove("hidden");
    selectedFiles.forEach((file, index) => {
        const fileItem = document.createElement("div");
        fileItem.className = "flex items-center justify-between bg-gray-50 px-4 py-2 rounded-xl border border-border-gray";

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
    renderFileList();
}

/* ==========================================================
   🟧 3. CUSTOM POPUP (Peringatan Form Belum Lengkap)
   ========================================================== */
function showWarningPopup() {
    document.getElementById('warningPopup').classList.remove('hidden');
}

function closeWarningPopup() {
    document.getElementById('warningPopup').classList.add('hidden');
}

/* ==========================================================
   🟨 4. SDGs GUIDE MODAL (Panduan & Contoh SDGs)
   ========================================================== */
let currentGuidePage = 1;
const itemsPerPage = 6;

function openSDGsGuideModal() {
    document.getElementById('sdgsGuideModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    currentGuidePage = 1;
    renderGuidePage();
}

function closeSDGsGuideModal() {
    document.getElementById('sdgsGuideModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function renderGuidePage() {
    const startIdx = (currentGuidePage - 1) * itemsPerPage;
    const endIdx = startIdx + itemsPerPage;
    const pageData = sdgsData.slice(startIdx, endIdx);

    const content = pageData.map(sdg => `
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl p-6 border-2 border-border-gray hover:border-slate-navy transition-all hover:shadow-lg">
            <div class="flex items-start gap-4 mb-3">
                <span class="bg-slate-navy text-white w-12 h-12 rounded-xl flex items-center justify-center font-bold text-lg flex-shrink-0">${sdg.nomor_kategori}</span>
                <h4 class="font-bold text-slate-navy leading-tight">${sdg.nama_kategori}</h4>
            </div>
            <p class="text-sm text-cool-gray leading-relaxed">${sdg.deskripsi.substring(0, 180)}...</p>
        </div>
    `).join('');

    document.getElementById('sdgsGuideContent').innerHTML = content;

    const totalPages = Math.ceil(sdgsData.length / itemsPerPage);
    document.getElementById('guidePageInfo').textContent = `Halaman ${currentGuidePage} dari ${totalPages}`;
    document.getElementById('guidePrevBtn').disabled = currentGuidePage === 1;
    document.getElementById('guideNextBtn').disabled = currentGuidePage === totalPages;
}

function nextGuidePage() {
    const totalPages = Math.ceil(sdgsData.length / itemsPerPage);
    if (currentGuidePage < totalPages) {
        currentGuidePage++;
        renderGuidePage();
    }
}

function prevGuidePage() {
    if (currentGuidePage > 1) {
        currentGuidePage--;
        renderGuidePage();
    }
}

/* ==========================================================
   🟪 5. FILE UPLOAD & PREVIEW GAMBAR (Bukti Kegiatan)
   ========================================================== */
function showFileName(input) {
    const fileList = document.getElementById('fileName');
    const files = Array.from(input.files);

    // Gabungkan file baru ke list lama tanpa duplikat
    files.forEach(file => {
        if (!selectedFiles.some(f => f.name === file.name)) {
            selectedFiles.push(file);
        }
    });

    fileList.innerHTML = '';
    fileList.classList.remove("hidden");

    // Tampilkan preview semua file yang dipilih
    selectedFiles.forEach((file, index) => {
        const fileItem = document.createElement("div");
        fileItem.className = "flex items-center justify-between bg-gray-50 px-4 py-2 rounded-xl border border-border-gray";

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
    showFileName({ files: [] });
}

/* ==========================================================
   🟫 6. SUBMIT FORM (AJAX JQUERY + LOADING OVERLAY)
   ========================================================== */
$(document).ready(function () {
    const $form = $("#kontribusiForm");

    $form.on("submit", function (e) {
        e.preventDefault();

        // Validasi step 2 + file wajib
        if (!validateForm(2)) {
            showWarningPopup();
            return;
        }

        $("#loadingOverlay").removeClass("hidden");

        const formData = new FormData(this);
        formData.delete("bukti_upload[]");
        selectedFiles.forEach(file => formData.append("bukti_upload[]", file));

        $.ajax({
            url: $form.attr("action"),
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').val()
            },
            success: function () {
                $("#loadingOverlay").addClass("hidden");
                console.log("✅ Kontribusi berhasil dikirim!");

                // Reset form
                selectedFiles = [];
                $("#fileName").addClass("hidden");
                $form.trigger("reset");
                closeKontribusiModal();
            },
            error: function (xhr) {
                $("#loadingOverlay").addClass("hidden");
                console.error("❌ Gagal mengirim data:", xhr.responseText);
            }
        });
    });
});

/* ==========================================================
   🟨 7. LOAD DATA DARI LOCALSTORAGE SAAT REFRESH
   ========================================================== */
function loadKontribusiDataOnRefresh() {
    const savedForm = JSON.parse(localStorage.getItem("kontribusiFormData") || "{}");

    // Kalau ada data tersimpan, buka modal
    if (Object.keys(savedForm).length > 0) {
        document.getElementById('kontribusiModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Isi form dengan data tersimpan
        if (savedForm.judul_kegiatan) document.getElementById("judulKegiatan").value = savedForm.judul_kegiatan;
        if (savedForm.tanggal_pelaksanaan) document.getElementById("tanggalKegiatan").value = savedForm.tanggal_pelaksanaan;
        if (savedForm.kategori_sdgs_id) document.getElementById("kategoriSdgs").value = savedForm.kategori_sdgs_id;
        if (savedForm.deskripsi_refleksi) document.getElementById("deskripsi_refleksi").value = savedForm.deskripsi_refleksi;
        if (savedForm.files && savedForm.files.length > 0) {
            selectedFiles = savedForm.files.map(f => ({ name: f.name, size: f.size, data: f.data }));
            renderFileList(true);
        }

        // Set step terakhir
        currentStep = savedForm.currentStep || 1;
        showStep(currentStep);
    }
}

function renderFileList(fromStorage = false) {
    const fileList = document.getElementById('fileName');
    fileList.innerHTML = '';
    if (selectedFiles.length === 0) { fileList.classList.add("hidden"); return; }
    fileList.classList.remove("hidden");

    selectedFiles.forEach((file, index) => {
        const fileItem = document.createElement("div");
        fileItem.className = "flex items-center justify-between bg-gray-50 px-4 py-2 rounded-xl border border-border-gray";

        if (fromStorage && file.data) {
            // Pakai preview dari data URL
            fileItem.innerHTML = `
                <div class="flex items-center gap-3">
                    <img src="${file.data}" class="w-12 h-12 rounded-lg object-cover border">
                    <div>
                        <p class="text-sm font-semibold text-slate-navy">${file.name}</p>
                        <p class="text-xs text-cool-gray">${(file.size / 1024).toFixed(1)} KB</p>
                    </div>
                </div>
                <button type="button" onclick="removeFile(${index})" class="text-red-500 hover:text-red-700 font-bold">✕</button>
            `;
        } else {
            // Pakai FileReader untuk file baru
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
                file.data = e.target.result; // simpan data URL ke localStorage
                saveFormData();
                fileList.appendChild(fileItem);
            };
            reader.readAsDataURL(file);
            return; // jangan append di sini, tunggu reader
        }

        fileList.appendChild(fileItem);
    });
}

// Simpan otomatis saat input berubah (tambahkan currentStep)
function saveFormData() {
    const formData = {
        currentStep,
        judul_kegiatan: document.getElementById("judulKegiatan").value,
        tanggal_pelaksanaan: document.getElementById("tanggalKegiatan").value,
        kategori_sdgs_id: document.getElementById("kategoriSdgs").value,
        deskripsi_refleksi: document.getElementById("deskripsi_refleksi").value,
        files: selectedFiles.map(f => ({
            name: f.name,
            size: f.size,
            data: f.data || null
        }))
    };
    localStorage.setItem("kontribusiFormData", JSON.stringify(formData));
}

// Panggil saat halaman siap
document.addEventListener("DOMContentLoaded", loadKontribusiDataOnRefresh);

// Panggil saveFormData setiap ada perubahan input
document.querySelectorAll("#kontribusiForm input, #kontribusiForm textarea, #kontribusiForm select").forEach(el => {
    el.addEventListener("input", saveFormData);
});

/* ==========================================================
   🟩 8. SHOW DATEPICKER
   ========================================================== */
const tanggalInput = document.getElementById('tanggalKegiatan');
tanggalInput.addEventListener('click', () => {
    if (tanggalInput.showPicker) {
        tanggalInput.showPicker();
    }
});
