<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kuliah - Planiza</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="font-inter bg-gradient-to-br from-off-white to-slate-100 min-h-screen overflow-x-hidden">

    <!-- Background Decorations -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-slate-navy/5 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-80 h-80 bg-cool-gray/5 rounded-full blur-3xl"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-2xl">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-border-gray/30 p-8 sm:p-10 lg:p-12">

                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-navy mb-3">
                        Form Kuliah Kamu 🎓
                    </h1>
                    <p class="text-cool-gray text-base sm:text-lg">
                        Isi data berikut untuk membantu Planiza merekomendasikan jurusan kuliah terbaik untukmu!
                    </p>
                </div>

                <form action="{{ route('siswa.kenali-jurusan.form-kuliah.store') }}" method="POST" id="formKuliah" class="space-y-6">
                    @csrf

                    <!-- Nilai UTBK -->
                    <div>
                        <label for="nilai_utbk" class="flex items-center gap-2 text-slate-navy font-semibold mb-3">
                            <i class="fa-solid fa-graduation-cap text-slate-navy"></i>
                            Nilai UTBK Kamu
                        </label>
                        <input type="number"
                               id="nilai_utbk"
                               name="nilai_utbk"
                               required
                               min="0"
                               max="1000"
                               placeholder="Contoh : 650"
                               class="w-full rounded-xl border-2 border-border-gray focus:border-slate-navy focus:ring-4 focus:ring-slate-navy/10 transition-all duration-300 p-3.5 text-slate-navy placeholder-cool-gray/50">
                    </div>

                    <!-- Pilih Jurusan -->
                    <div>
                        <label class="flex items-center justify-between text-slate-navy font-semibold mb-3">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-book text-slate-navy"></i>
                                Pilih Jurusan yang Kamu Minati
                            </span>
                            <span class="text-sm font-bold px-3 py-1 bg-slate-navy text-white rounded-full" id="jurusanCounter">
                                0/3
                            </span>
                        </label>

                        <!-- Checkbox Grid dengan Scroll -->
                        <div class="border-2 border-border-gray rounded-xl p-2 bg-off-white max-h-72 overflow-y-auto space-y-2 scrollbar-thin scrollbar-thumb-cool-gray scrollbar-track-off-white">
                            @foreach ($jurusanKuliah as $jurusan)
                            <div class="jurusan-item">
                                <input type="checkbox"
                                       id="jurusan_{{ $jurusan->id }}"
                                       name="jurusan_kuliah_ids[]"
                                       value="{{ $jurusan->id }}"
                                       class="jurusan-checkbox hidden peer">
                                <label for="jurusan_{{ $jurusan->id }}"
                                       class="flex items-center justify-between p-3.5 bg-white border-2 border-border-gray rounded-xl cursor-pointer transition-all duration-200 hover:border-slate-navy hover:shadow-md peer-checked:bg-slate-navy peer-checked:border-slate-navy peer-checked:text-white peer-checked:shadow-lg peer-checked:scale-[1.01] peer-disabled:opacity-40 peer-disabled:cursor-not-allowed peer-disabled:hover:border-border-gray peer-disabled:hover:shadow-none">
                                    <span class="font-medium text-sm sm:text-base">{{ $jurusan->nama_jurusan_kuliah }}</span>
                                    <i class="fa-solid fa-check text-xs opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <p class="flex items-center gap-2 text-sm text-cool-gray mt-2.5">
                            <i class="fa-solid fa-info-circle text-slate-navy"></i>
                            Kamu bisa memilih maksimal 3 jurusan
                        </p>
                    </div>

                    <!-- Submit Button -->
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

    <!-- JavaScript -->
    <script>
        const jurusanCheckboxes = document.querySelectorAll('.jurusan-checkbox');
        const jurusanCounter = document.getElementById('jurusanCounter');
        const form = document.getElementById('formKuliah');
        const MAX_SELECTION = 3;

        function updateCounter() {
            const checkedCount = document.querySelectorAll('.jurusan-checkbox:checked').length;
            jurusanCounter.textContent = `${checkedCount}/3`;

            // Disable checkbox yang belum dipilih jika sudah mencapai limit
            jurusanCheckboxes.forEach(checkbox => {
                if (!checkbox.checked && checkedCount >= MAX_SELECTION) {
                    checkbox.disabled = true;
                } else {
                    checkbox.disabled = false;
                }
            });
        }

        // Event listener untuk setiap checkbox
        jurusanCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateCounter);
        });

        // Validasi saat submit
        form.addEventListener('submit', function(e) {
            const checkedCount = document.querySelectorAll('.jurusan-checkbox:checked').length;

            if (checkedCount === 0) {
                e.preventDefault();
                alert('⚠️ Pilih minimal 1 jurusan!');
                return;
            }

            if (checkedCount > MAX_SELECTION) {
                e.preventDefault();
                alert(`⚠️ Kamu hanya bisa memilih maksimal ${MAX_SELECTION} jurusan!`);
            }
        });
    </script>
</body>
</html>
