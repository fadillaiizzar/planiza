<div id="modalEditTanggapan-{{ $tanggapan->id }}" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-slate-800">Edit Tanggapan</h3>
        </div>

        <form action="{{ route('admin.tanggapan-karier.update', $tanggapan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <textarea name="isi_tanggapan" rows="5" required
                      class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-slate-300 focus:outline-none"
                      placeholder="Edit tanggapan...">{{ old('isi_tanggapan', $tanggapan->isi_tanggapan) }}</textarea>

            @error('isi_tanggapan')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeModal('modalEditTanggapan-{{ $tanggapan->id }}')"
                        class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
