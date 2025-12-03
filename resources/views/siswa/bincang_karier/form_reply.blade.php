<div class="bg-white border border-gray-200 rounded-2xl shadow p-6 mt-8">
    <h3 class="text-lg font-semibold text-slate-800 mb-3">Balas Pertanyaan</h3>

    <form action="{{ route('siswa.tanggapan-karier.store') }}" method="POST">
        @csrf

        <input type="hidden" name="bincang_karier_id" value="{{ $bincangKarier->id }}">

        <textarea name="isi_tanggapan"
                    rows="5"
                    required
                    class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-slate-300 focus:outline-none"
                    placeholder="Tulis tanggapanmu di sini...">{{ old('isi_tanggapan') }}</textarea>

        @error('isi_tanggapan')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror

        <button type="submit"
            class="mt-4 bg-slate-navy text-white px-5 py-2 rounded-xl text-sm font-semibold hover:shadow-lg transition flex items-center gap-2">
            <i class="fas fa-paper-plane text-xs"></i>
            Kirim Tanggapan
        </button>
    </form>
</div>
