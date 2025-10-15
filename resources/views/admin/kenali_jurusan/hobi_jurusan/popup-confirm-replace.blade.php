<div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black/40 hidden">
    <div class="bg-white rounded-xl shadow-lg w-96 py-5 px-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-3">Data Sudah Ada</h2>
        <p class="text-sm text-gray-600 mb-6">
            Kombinasi hobi dan jurusan ini sudah pernah dibuat.
            Apakah kamu ingin <span class="font-semibold">mengganti poin</span> yang lama ?
        </p>

        <div class="flex justify-center gap-3">
            <button id="cancelBtn"
                class="px-4 py-2 rounded-lg text-gray-800 hover:underline transition">
                Batal
            </button>
            <button id="confirmBtn"
                class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                Ganti
            </button>
        </div>
    </div>
</div>

<script>
    function showConfirmModal(onConfirm) {
        const modal = document.getElementById('confirmModal');
        modal.classList.remove('hidden');

        const cancelBtn = document.getElementById('cancelBtn');
        const confirmBtn = document.getElementById('confirmBtn');

        cancelBtn.onclick = () => {
            modal.classList.add('hidden');
        };
        confirmBtn.onclick = () => {
            modal.classList.add('hidden');
            if (onConfirm) onConfirm();
        };
    }
</script>
