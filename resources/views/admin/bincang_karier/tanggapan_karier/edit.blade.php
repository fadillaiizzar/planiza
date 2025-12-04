<div id="modalEditTanggapan-{{ $tanggapan->id }}"
     class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-5">

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200
                overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-none">

        <!-- Header -->
        <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 20h9M3 20h9m-9-4h6m-6-4h12M3 8h12M3 4h18" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-white">Edit Tanggapan Karier</h2>
            </div>
        </div>

        <!-- Body -->
        <div class="px-6 pt-4 pb-6">

            <form action="{{ route('admin.tanggapan-karier.update', $tanggapan->id) }}" method="POST"
                  class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Textarea -->
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700">Tanggapan</label>
                    <textarea name="isi_tanggapan" rows="5" required
                              class="w-full px-3 py-2 border border-slate-300 rounded-xl text-sm text-slate-900 bg-white focus:ring-2 focus:ring-slate-300 focus:outline-none">{{ old('isi_tanggapan', $tanggapan->isi_tanggapan) }}</textarea>

                    @error('isi_tanggapan')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-center pt-4 gap-5">
                    <button type="button"
                            onclick="closeModal('modalEditTanggapan-{{ $tanggapan->id }}')"
                            class="text-slate-600 hover:text-slate-800 font-medium transition-all duration-200 hover:underline">
                        Batal
                    </button>

                    <button type="submit"
                            class="bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white font-semibold px-6 py-2 rounded-xl transition-all duration-200">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
