<div id="modalDeleteTanggapan-{{ $tanggapan->id }}" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-red-600">Hapus Tanggapan</h3>
        </div>

        <p class="text-slate-700 mb-4">Apakah kamu yakin ingin menghapus tanggapan ini? Aksi ini tidak bisa dikembalikan.</p>

        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal('modalDeleteTanggapan-{{ $tanggapan->id }}')"
                    class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                Batal
            </button>

            <form action="{{ route('admin.tanggapan-karier.destroy', $tanggapan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
