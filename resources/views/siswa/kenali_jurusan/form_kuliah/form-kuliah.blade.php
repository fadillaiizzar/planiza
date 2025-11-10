<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kuliah - Planiza</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="font-inter bg-gradient-to-br from-off-white to-slate-100 min-h-screen overflow-x-hidden">

    <!-- Background efek -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-slate-navy/5 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-80 h-80 bg-cool-gray/5 rounded-full blur-3xl"></div>
    </div>

    <!-- Konten utama -->
    <div class="relative z-10 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-2xl">
            <div class="relative bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-border-gray/30 p-8 sm:p-10 lg:p-12">
                <!-- Tombol Kembali (ikon silang) -->
                <button id="btnKembali"
                    class="absolute top-4 right-4 text-red-500 hover:text-red-600 bg-red-50 hover:bg-red-100 transition-all rounded-full w-9 h-9 flex items-center justify-center shadow-sm"
                    title="Kembali">
                    <i class="fa-solid fa-xmark text-2xl"></i>
                </button>

                <div class="text-center mb-8">
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-navy mb-3">
                        Form Kuliah Kamu 🎓
                    </h1>
                    <p class="text-cool-gray text-base sm:text-lg">
                        Isi data berikut untuk membantu Planiza merekomendasikan jurusan kuliah terbaik untukmu!
                    </p>
                </div>

                <!-- Form -->
                <form action="{{ route('siswa.kenali-jurusan.form-kuliah.submit', $formKuliah->id) }}" method="POST" id="formKuliah" class="space-y-6">
                    @csrf
                    <input type="hidden" name="attempt" value="{{ $activeAttempt }}">

                    <!-- Nilai UTBK -->
                    <div>
                        <label for="nilai_utbk" class="flex items-center gap-2 text-slate-navy font-semibold mb-3">
                            <i class="fa-solid fa-graduation-cap text-slate-navy"></i>
                            Nilai UTBK Kamu
                        </label>
                        <input type="number" id="nilai_utbk" name="nilai_utbk" value="{{ $nilaiUtbk ?? '' }}" required min="0" max="1000" placeholder="Contoh : 650" class="w-full rounded-xl border-2 border-border-gray focus:border-slate-navy focus:ring-4 focus:ring-slate-navy/10 transition-all duration-300 p-3.5 text-slate-navy placeholder-cool-gray/50">
                    </div>

                    <!-- Pilih Jurusan -->
                    <div>
                        <label for="jurusan_kuliah_ids" class="flex items-center justify-between text-slate-navy font-semibold mb-3">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-book text-slate-navy"></i>
                                Pilih Jurusan yang Kamu Minati
                            </span>
                            <span id="jurusanCounter" class="text-sm font-bold px-3 py-1 bg-slate-navy text-white rounded-full">
                                0/3
                            </span>
                        </label>
                        <select id="jurusan_kuliah_ids" name="jurusan_kuliah_ids[]" multiple required
                            class="w-full rounded-2xl border-2 border-border-gray focus:border-slate-navy focus:ring-4 focus:ring-slate-navy/10 transition-all duration-300 p-3.5 text-slate-navy">
                            @foreach ($jurusanKuliah as $jurusan)
                                <option value="{{ $jurusan->id }}"
                                    @if(in_array($jurusan->id, $jurusanSelected ?? [])) selected @endif
                                >{{ $jurusan->nama_jurusan_kuliah }}</option>
                            @endforeach
                        </select>
                        <p class="text-sm text-cool-gray mt-2.5 flex items-center gap-2">
                            <i class="fa-solid fa-info-circle text-slate-navy"></i>
                            Kamu bisa memilih maksimal 3 jurusan
                        </p>
                    </div>

                    <!-- Pilih Hobi -->
                    <div>
                        <label for="hobi_ids" class="flex items-center justify-between text-slate-navy font-semibold mb-3">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-heart text-slate-navy"></i>
                                Pilih Hobi Kamu
                            </span>
                            <span id="hobiCounter" class="text-sm font-bold px-3 py-1 bg-slate-navy text-white rounded-full">
                                0/3
                            </span>
                        </label>
                        <select id="hobi_ids" name="hobi_ids[]" multiple required
                            class="w-full rounded-xl border-2 border-border-gray focus:border-slate-navy focus:ring-4 focus:ring-slate-navy/10 transition-all duration-300 p-3.5 text-slate-navy">
                            @foreach ($hobis as $hobi)
                                <option value="{{ $hobi->id }}"
                                    @if(in_array($hobi->id, $hobiSelected ?? [])) selected @endif
                                >{{ $hobi->nama_hobi }}</option>
                            @endforeach
                        </select>
                        <p class="text-sm text-cool-gray mt-2.5 flex items-center gap-2">
                            <i class="fa-solid fa-info-circle text-slate-navy"></i>
                            Kamu bisa memilih maksimal 3 hobi
                        </p>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-3 bg-slate-navy hover:bg-slate-navy/90 text-white font-semibold rounded-xl px-8 py-4 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-100">
                            <i class="fa-solid fa-paper-plane"></i>
                            Kirim Form Kuliah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Popup Konfirmasi Keluar -->
    @include('siswa.kenali_jurusan.form_kuliah.form_kuliah.popup-konfirmasi-keluar')

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const MAX_SELECTION = 3;
        const saveUrl = "{{ route('siswa.kenali-jurusan.form-kuliah.store', $formKuliah->id) }}";
        const attempt = "{{ $activeAttempt }}";

        // Inisialisasi Select2
        $('#jurusan_kuliah_ids, #hobi_ids').select2({
            maximumSelectionLength: MAX_SELECTION,
            width: '100%'
        });

        // --- Counter update ---
        function updateCounter(selectId, counterId) {
            const count = $(`#${selectId}`).val()?.length || 0;
            document.getElementById(counterId).textContent = `${count}/${MAX_SELECTION}`;
        }
        $('#jurusan_kuliah_ids').on('change', () => updateCounter('jurusan_kuliah_ids', 'jurusanCounter'));
        $('#hobi_ids').on('change', () => updateCounter('hobi_ids', 'hobiCounter'));
        updateCounter('jurusan_kuliah_ids', 'jurusanCounter');
        updateCounter('hobi_ids', 'hobiCounter');

        // --- Validasi sebelum submit form ---
        $('#formKuliah').on('submit', function (e) {
            const jurusan = $('#jurusan_kuliah_ids').val();
            const hobi = $('#hobi_ids').val();

            if (!jurusan || jurusan.length === 0) {
                e.preventDefault();
                alert('⚠️ Pilih minimal 1 jurusan!');
                return;
            }
            if (!hobi || hobi.length === 0) {
                e.preventDefault();
                alert('⚠️ Pilih minimal 1 hobi!');
                return;
            }
        });

        const submitUrl = "{{ route('siswa.kenali-jurusan.form-kuliah.submit', $formKuliah->id) }}";

        // Submit pakai FETCH (tampilkan di console hasil sukses/gagal)
        document.getElementById('formKuliah').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);

            fetch(submitUrl, {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    console.log('%c✅ Sukses:', 'color: #22c55e; font-weight: bold;', data.message);
                    console.log('%c➡️ Redirect ke halaman rekomendasi:', 'color: #3b82f6; font-weight: bold;', data.redirect_url);
                    clearLocalStorage();
                    window.location.href = data.redirect_url;
                } else {
                    console.log('%c⚠️ Gagal:', 'color: #eab308; font-weight: bold;', data.message);
                }
            })
            .catch(err => {
                console.error('%c❌ Error jaringan:', 'color: #ef4444; font-weight: bold;', err);
            });
        });

        // --- Tambahan fitur localStorage ---
        const STORAGE_KEY = "formKuliahData";

        function saveToLocalStorage() {
            const nilaiUtbk = document.getElementById('nilai_utbk').value;
            const jurusan = $('#jurusan_kuliah_ids').val();
            const hobi = $('#hobi_ids').val();
            const data = { nilaiUtbk, jurusan, hobi };
            localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        }

        function restoreFromLocalStorage() {
            const savedData = localStorage.getItem(STORAGE_KEY);
            if (savedData) {
                const data = JSON.parse(savedData);
                if (data.nilaiUtbk) document.getElementById('nilai_utbk').value = data.nilaiUtbk;
                if (data.jurusan?.length) {
                    $('#jurusan_kuliah_ids').val(data.jurusan).trigger('change');
                    updateCounter('jurusan_kuliah_ids', 'jurusanCounter');
                }
                if (data.hobi?.length) {
                    $('#hobi_ids').val(data.hobi).trigger('change');
                    updateCounter('hobi_ids', 'hobiCounter');
                }
            }
        }

        function clearLocalStorage() {
            localStorage.removeItem(STORAGE_KEY);
        }

        document.addEventListener("DOMContentLoaded", restoreFromLocalStorage);
        document.getElementById('nilai_utbk').addEventListener('input', saveToLocalStorage);
        $('#jurusan_kuliah_ids, #hobi_ids').on('change', saveToLocalStorage);

        // --- Tombol Kembali pakai Popup Custom ---
        const btnKembali = document.getElementById('btnKembali');
        const popupKeluar = document.getElementById('popupKeluar');
        const batalKeluar = document.getElementById('batalKeluar');
        const konfirmasiKeluar = document.getElementById('konfirmasiKeluar');

        btnKembali.addEventListener('click', function (e) {
            e.preventDefault();
            popupKeluar.classList.remove('hidden');
        });

        batalKeluar.addEventListener('click', function () {
            popupKeluar.classList.add('hidden');
        });

        // Tutup popup kalau klik di luar kontennya
        popupKeluar.addEventListener('click', function (e) {
            if (e.target === popupKeluar) {
                popupKeluar.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
