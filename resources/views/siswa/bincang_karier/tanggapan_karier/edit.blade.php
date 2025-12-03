{{-- Modal Edit Tanggapan --}}
<div id="modalEditTanggapan-{{ $tanggapan->id }}"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-lg p-6 shadow-lg">
        <h2 class="text-lg font-semibold mb-3">Edit Tanggapan</h2>

        <form action="{{ route('siswa.tanggapan-karier.update', $tanggapan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <textarea name="isi_tanggapan"
                      rows="5"
                      class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-slate-300"
                      required>{{ $tanggapan->isi_tanggapan }}</textarea>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button"
                        onclick="closeModal('modalEditTanggapan-{{ $tanggapan->id }}')"
                        class="px-4 py-2 rounded-lg border text-gray-700">
                        Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Simpan
                </button>
            </div>
        </form>
    </div>
</div>
