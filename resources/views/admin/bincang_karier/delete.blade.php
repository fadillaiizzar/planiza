<div id="deleteBincangModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h3 class="text-lg font-semibold mb-4">Hapus Pertanyaan</h3>
        <p>Apakah Anda yakin ingin menghapus pertanyaan berikut?</p>
        <p id="deleteNamaBincang" class="font-medium my-4"></p>
        <div class="flex justify-end gap-3 mt-6">
            <button onclick="closeDeleteModal()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Batal</button>
            <form id="deleteBincangForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>
</div>
