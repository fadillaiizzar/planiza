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

// Kontribusi Modal
let currentStep = 1;

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
}

function showStep(step) {
    document.getElementById('step1').classList.toggle('hidden', step !== 1);
    document.getElementById('step2').classList.toggle('hidden', step !== 2);
    document.getElementById('prevBtn').disabled = step === 1;
    document.getElementById('nextBtn').classList.toggle('hidden', step === 2);
    document.getElementById('submitBtn').classList.toggle('hidden', step === 1);
    document.getElementById('stepIndicator').textContent = `Step ${step} dari 2`;
}

function nextStep() {
    const judul = document.getElementById('judulKegiatan').value;
    const tanggal = document.getElementById('tanggalKegiatan').value;

    if (!judul || !tanggal) {
        alert('Mohon lengkapi semua field yang wajib diisi');
        return;
    }

    currentStep = 2;
    showStep(2);
}

function prevStep() {
    currentStep = 1;
    showStep(1);
}

function showFileName(input) {
    const fileName = input.files[0]?.name;
    if (fileName) {
        document.getElementById('fileNameText').textContent = `File dipilih: ${fileName}`;
        document.getElementById('fileName').classList.remove('hidden');
    }
}

// SDGs Guide Modal
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

// Close modals on outside click
window.onclick = function(event) {
    if (event.target.id === 'sdgDetailModal') closeSDGDetail();
    if (event.target.id === 'kontribusiModal') closeKontribusiModal();
    if (event.target.id === 'sdgsGuideModal') closeSDGsGuideModal();
}

// Prevent body scroll when modal is open
document.addEventListener('DOMContentLoaded', function() {
    const modals = document.querySelectorAll('[id$="Modal"]');
    modals.forEach(modal => {
        modal.addEventListener('wheel', function(e) {
            e.stopPropagation();
        });
    });
});
