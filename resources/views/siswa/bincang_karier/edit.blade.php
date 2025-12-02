<div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6 relative">

    {{-- Close --}}
    <button onclick="closeEditBincang()"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
        <i class="fas fa-times text-xl"></i>
    </button>

    <h2 class="text-xl font-semibold text-slate-800 mb-4">Edit Pertanyaan</h2>

    <form id="formEditBincang" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="text-sm font-medium text-slate-700">Pertanyaan</label>
            <textarea
                name="isi_pertanyaan"
                id="editIsiPertanyaan"
                rows="5"
                class="w-full border border-gray-300 rounded-xl p-3 mt-1 focus:ring focus:ring-blue-200"
                placeholder="Tulis pertanyaanmu..."
                required></textarea>
        </div>

        <div class="flex justify-end gap-3 mt-5">
            <button type="button"
                onclick="closeEditBincang()"
                class="px-4 py-2 rounded-lg border">
                Batal
            </button>

            <button type="submit"
                class="px-4 py-2 rounded-lg bg-slate-navy text-white">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
