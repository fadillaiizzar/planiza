{{-- Modal Delete Tanggapan --}}
<div id="modalDeleteTanggapan-{{ $tanggapan->id }}"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-md p-6 shadow-lg">
        <h2 class="text-lg font-semibold mb-4 text-red-600">Hapus Tanggapan?</h2>

        <p class="text-gray-700 mb-4">Yakin ingin menghapus tanggapan ini? Tindakan ini tidak bisa dibatalkan.</p>

        <form action="{{ route('siswa.tanggapan-karier.destroy', $tanggapan->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeModal('modalDeleteTanggapan-{{ $tanggapan->id }}')"
                        class="px-4 py-2 rounded-lg border text-gray-700">
                        Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Hapus
                </button>
            </div>
        </form>
    </div>
</div>
