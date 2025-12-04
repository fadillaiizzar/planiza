<div id="modalDeleteTanggapan-{{ $tanggapan->id }}"
     class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm p-4">

    <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-2xl border border-[#CBD5E1] relative overflow-hidden">

        <!-- Garis Gradient -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-red-600"></div>

        <!-- Icon -->
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>

            <!-- Judul -->
            <h3 class="text-xl font-bold text-[#1E293B] mb-2">Hapus Tanggapan</h3>

            <!-- Isi Teks -->
            <p class="text-[#64748B] mb-6 leading-relaxed text-sm sm:text-base">
                Apakah Anda yakin ingin menghapus tanggapan
                <span>
                    {{ Str::limit($tanggapan->isi_tanggapan, 60) }} ?
                </span>

                <span class="text-sm text-red-500 mt-2 block">Tindakan ini tidak dapat dibatalkan</span>
            </p>

            <!-- Form delete -->
            <form method="POST"
                  action="{{ route('admin.tanggapan-karier.destroy', $tanggapan->id) }}"
                  class="flex flex-row justify-center gap-5">
                @csrf
                @method('DELETE')

                <button type="button"
                        onclick="closeModal('modalDeleteTanggapan-{{ $tanggapan->id }}')"
                        class="hover:underline text-[#64748B] hover:bg-[#F9FAFB] transition-all duration-200 font-medium w-full sm:w-auto">
                    Batal
                </button>

                <button type="submit"
                        class="px-6 py-2 rounded-full bg-gradient-to-r from-red-500 to-red-600
                               text-white hover:from-red-600 hover:to-red-700 transition-all duration-200
                               font-medium shadow-md hover:shadow-lg w-full sm:w-auto">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
