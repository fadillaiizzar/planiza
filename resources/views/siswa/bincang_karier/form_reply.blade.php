<div class="bg-white border border-border-gray rounded-2xl shadow-sm mt-6 overflow-hidden">
    <div class="bg-gradient-to-br from-off-white to-white px-6 py-4 border-b border-border-gray">
        <h3 class="text-lg font-bold text-slate-navy flex items-center gap-2">
            <i class="fas fa-reply text-cool-gray"></i>
            Balas Pertanyaan
        </h3>
    </div>

    <form action="{{ route('siswa.tanggapan-karier.store') }}" method="POST" class="p-6">
        @csrf
        <input type="hidden" name="bincang_karier_id" value="{{ $bincangKarier->id }}">

        <div class="mb-4">
            <textarea name="isi_tanggapan"
                        rows="5"
                        required
                        class="w-full border border-border-gray rounded-xl p-4 text-sm focus:ring-2 focus:ring-slate-navy focus:border-transparent transition-all resize-none bg-off-white"
                        placeholder="Tulis tanggapanmu di sini...">{{ old('isi_tanggapan') }}</textarea>

            @error('isi_tanggapan')
                <p class="text-red-600 text-xs mt-2 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
            <p class="text-xs text-cool-gray mb-3 md:mb-0">
                <i class="fas fa-info-circle"></i>
                Tanggapanmu akan terlihat oleh semua pengguna
            </p>
            <button type="submit"
                class="bg-slate-navy text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-opacity-90 shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-2">
                <i class="fas fa-paper-plane text-xs"></i>
                Kirim Tanggapan
            </button>
        </div>
    </form>
</div>
