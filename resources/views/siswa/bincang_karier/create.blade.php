<div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6 relative">
    <h2 class="text-xl font-semibold text-slate-800 mb-4">Buat Pertanyaan Baru</h2>

    <form action="{{ route('siswa.bincang-karier.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="text-sm font-medium text-slate-700">Pertanyaan</label>
            <textarea
                name="isi_pertanyaan"
                rows="5"
                class="w-full border border-gray-300 rounded-xl p-3 mt-1 focus:ring focus:ring-blue-200"
                placeholder="Tulis pertanyaanmu di sini..."
                required></textarea>
        </div>

        <div class="flex justify-end gap-3 mt-5">
            <button type="button"
                onclick="closeCreateBincang()"
                class="px-4 py-2 rounded-lg border">
                Batal
            </button>

            <button type="submit"
                class="px-4 py-2 rounded-lg bg-slate-navy text-white">
                Kirim
            </button>
        </div>
    </form>
</div>
