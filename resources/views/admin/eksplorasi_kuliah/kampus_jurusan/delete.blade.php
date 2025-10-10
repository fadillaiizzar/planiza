<div id="deleteRelasiModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-2xl border border-[#CBD5E1] relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-red-600"></div>

        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-trash-alt text-red-600 text-2xl"></i>
            </div>

            <h3 class="text-xl font-bold text-[#1E293B] mb-2">Hapus Relasi Kampus - Jurusan</h3>
            <p class="text-[#64748B] mb-6 leading-relaxed text-sm sm:text-base">
                Apakah Anda yakin ingin menghapus relasi
                <br>
                <span id="deleteRelasiKampus"></span>
                ↔
                <span id="deleteRelasiJurusan"></span> ?
                <br>
                <span class="text-sm text-red-500 mt-2 block">Tindakan ini tidak dapat dibatalkan</span>
            </p>

            <form id="deleteRelasiForm" method="POST" class="flex flex-row justify-center gap-5">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteRelasiModal()"
                        class="hover:underline text-[#64748B] hover:bg-[#F9FAFB] transition-all duration-200 font-medium w-full sm:w-auto">
                    Batal
                </button>
                <button type="submit"
                        class="px-6 py-2 rounded-full bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg w-full sm:w-auto">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
     function showDeleteRelasiModal(id, kampusName, jurusanName, action) {
        document.getElementById('deleteRelasiModal').classList.remove('hidden');
        document.getElementById('deleteRelasiKampus').textContent = kampusName;
        document.getElementById('deleteRelasiJurusan').textContent = jurusanName;
        document.getElementById('deleteRelasiForm').action = action;
    }

    function closeDeleteRelasiModal() {
        document.getElementById('deleteRelasiModal').classList.add('hidden');
    }
</script>
