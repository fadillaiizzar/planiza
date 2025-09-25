<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Siswa - Planiza')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="font-inter bg-gradient-to-br from-off-white to-slate-100 min-h-screen">
    <!-- Background Pattern -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-80 h-80 bg-purple-500/5 rounded-full blur-3xl"></div>
    </div>

    <!-- Progress Bar Fixed -->
    <div class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-border-gray/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clipboard-check text-white text-sm"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-slate-navy">{{ $tes->nama_tes }}</h1>
                        <p class="text-sm text-cool-gray">Kerjakan semua soal sesuai dengan minatmu</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm font-semibold text-slate-navy" id="question-counter">1 / {{ $soals->count() }}</div>
                    <div class="text-xs text-cool-gray">Pertanyaan</div>
                </div>
            </div>
            <div class="w-full bg-border-gray/30 rounded-full h-2">
                <div id="progress-bar" class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full transition-all duration-500" style="width: {{ (1 / $soals->count()) * 100 }}%"></div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="relative z-10 pt-32 pb-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Test Container -->
            <div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 p-6 sm:p-8 lg:p-12">
                <!-- Questions Container -->
                <div id="soal-container" class="min-h-[400px]">
                    @foreach ($soals as $index => $soal)
                        <div class="soal-item {{ $index === 0 ? '' : 'hidden' }}" data-index="{{ $index }}">
                            <!-- Question Header -->
                            <div class="mb-8 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl mb-6 shadow-lg">
                                    <span class="text-white text-xl font-bold">{{ $index + 1 }}</span>
                                </div>
                                <h2 class="text-2xl sm:text-3xl font-bold text-slate-navy mb-4 leading-tight">
                                    {{ $soal->isi_pertanyaan }}
                                </h2>
                                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mx-auto"></div>
                            </div>

                            <!-- Answer Options -->
                            <div class="grid gap-4 sm:gap-5 max-w-3xl mx-auto">
                                @foreach ($soal->opsiJawabans as $opsiIndex => $opsi)
                                    <button class="group opsi-btn relative overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-[1.02] transform rounded-2xl
                                        {{ $soal->jawabanSiswa && $soal->jawabanSiswa->opsi_jawaban_id == $opsi->id
                                            ? 'bg-blue-600 border-2 border-blue-600 text-white shadow-xl scale-[1.02]'
                                            : 'bg-white hover:bg-blue-50 border-2 border-border-gray/30 hover:border-blue-300/50 text-slate-navy' }}"
                                        data-soal="{{ $soal->id }}"
                                        data-opsi="{{ $opsi->id }}">

                                        <div class="flex items-center space-x-4 p-5 sm:p-3">
                                            <!-- Option Letter Badge -->
                                            <div class="flex-shrink-0 w-12 h-12 rounded-xl border-2 flex items-center justify-center font-bold text-base transition-all duration-300
                                                {{ $soal->jawabanSiswa && $soal->jawabanSiswa->opsi_jawaban_id == $opsi->id
                                                    ? 'bg-white/20 border-white/40 text-white'
                                                    : 'border-border-gray/50 text-cool-gray group-hover:border-blue-400 group-hover:text-blue-600 group-hover:bg-blue-50' }}">
                                                {{ chr(65 + $opsiIndex) }}
                                            </div>

                                            <!-- Option Text -->
                                            <div class="flex-1 text-left">
                                                <p class="font-medium leading-relaxed text-base transition-colors duration-300
                                                    {{ $soal->jawabanSiswa && $soal->jawabanSiswa->opsi_jawaban_id == $opsi->id
                                                        ? 'text-white'
                                                        : 'text-slate-navy group-hover:text-blue-700' }}">
                                                    {{ $opsi->isi_opsi }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Hover Effect Background -->
                                        <div class="absolute inset-0 bg-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl
                                            {{ $soal->jawabanSiswa && $soal->jawabanSiswa->opsi_jawaban_id == $opsi->id ? 'hidden' : '' }}"></div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation -->
                <div class="mt-12 pt-8 border-t border-border-gray/20">
                    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                        <button id="prev-btn"
                            class="w-full sm:w-auto px-8 py-4 bg-white hover:bg-gray-50 border-2 border-border-gray/30 hover:border-border-gray text-cool-gray hover:text-slate-navy rounded-2xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-white disabled:hover:border-border-gray/30"
                            disabled>
                            <i class="fas fa-arrow-left text-sm"></i>
                            <span>Sebelumnya</span>
                        </button>

                        <div class="hidden sm:block text-center">
                            <div class="text-sm text-cool-gray">Tekan spasi untuk melanjutkan</div>
                        </div>

                        <button id="next-btn"
                            class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-2xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <span>Selanjutnya</span>
                            <i class="fas fa-arrow-right text-sm"></i>
                        </button>

                        <form id="submit-form" action="{{ route('siswa.kenali-profesi.tes.submit', $tes->id) }}" method="POST" class="hidden w-full sm:w-auto">
                            @csrf
                            <button type="submit"
                                class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-2xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <i class="fas fa-check-circle text-sm"></i>
                                <span>Selesai & Lihat Rekomendasi</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-white rounded-3xl p-8 mx-4 text-center shadow-2xl">
            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                <i class="fas fa-spinner fa-spin text-white text-xl"></i>
            </div>
            <p class="text-slate-navy font-semibold">Menyimpan jawaban...</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const soalItems = document.querySelectorAll('.soal-item');
        const totalSoal = soalItems.length;
        let currentIndex = 0;

        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitForm = document.getElementById('submit-form');
        const progressBar = document.getElementById('progress-bar');
        const questionCounter = document.getElementById('question-counter');
        const loadingOverlay = document.getElementById('loading-overlay');

        function updateProgress() {
            const progress = ((currentIndex + 1) / totalSoal) * 100;
            progressBar.style.width = `${progress}%`;
            questionCounter.textContent = `${currentIndex + 1} / ${totalSoal}`;
        }

        function showSoal(index) {
            soalItems.forEach((item, i) => {
                if (i === index) {
                    item.classList.remove('hidden');
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        item.style.transition = 'all 0.5s ease-out';
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    item.classList.add('hidden');
                }
            });

            prevBtn.disabled = index === 0;

            if (index === soalItems.length - 1) {
                nextBtn.classList.add('hidden');
                submitForm.classList.remove('hidden');
            } else {
                nextBtn.classList.remove('hidden');
                submitForm.classList.add('hidden');
            }

            updateProgress();
        }

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                showSoal(currentIndex);
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentIndex < soalItems.length - 1) {
                currentIndex++;
                showSoal(currentIndex);
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.code === 'Space' && !nextBtn.classList.contains('hidden')) {
                e.preventDefault();
                nextBtn.click();
            } else if (e.code === 'ArrowLeft' && !prevBtn.disabled) {
                e.preventDefault();
                prevBtn.click();
            } else if (e.code === 'ArrowRight' && !nextBtn.classList.contains('hidden')) {
                e.preventDefault();
                nextBtn.click();
            }
        });

        $(document).on('click', '.opsi-btn', function () {
            const soalId = $(this).data('soal');
            const opsiId = $(this).data('opsi');
            const btn = $(this);

            loadingOverlay.classList.remove('hidden');

            $.ajax({
                url: `/siswa/kenali-profesi/tes/${soalId}/jawab`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    opsi_jawaban_id: opsiId
                },
                success: function (res) {
                    loadingOverlay.classList.add('hidden');

                    if (res.success) {
                        // Reset all options in current question
                        btn.parent().find('.opsi-btn').each(function() {
                            const $this = $(this);
                            const letterBadge = $this.find('div').first().find('div').first();
                            const optionText = $this.find('p');
                            const radioIndicator = $this.find('div').last();

                            // Reset to unselected state
                            $this.removeClass('bg-blue-600 border-blue-600 text-white shadow-xl scale-[1.02]')
                                 .addClass('bg-white hover:bg-blue-50 border-border-gray/30 hover:border-blue-300/50 text-slate-navy');

                            // Reset letter badge
                            letterBadge.removeClass('bg-white/20 border-white/40 text-white')
                                      .addClass('border-border-gray/50 text-cool-gray group-hover:border-blue-400 group-hover:text-blue-600 group-hover:bg-blue-50');

                            // Reset option text
                            optionText.removeClass('text-white')
                                     .addClass('text-slate-navy group-hover:text-blue-700');

                            // Reset radio indicator
                            radioIndicator.removeClass('border-white bg-white')
                                         .addClass('border-border-gray/50 group-hover:border-blue-400 group-hover:bg-blue-50')
                                         .empty(); // Remove inner circle

                            // Show hover effect for unselected
                            $this.find('.absolute').removeClass('hidden');
                        });

                        // Style selected option
                        const selectedLetterBadge = btn.find('div').first().find('div').first();
                        const selectedText = btn.find('p');
                        const selectedRadio = btn.find('div').last();

                        btn.removeClass('bg-white hover:bg-blue-50 border-border-gray/30 hover:border-blue-300/50 text-slate-navy')
                           .addClass('bg-blue-600 border-blue-600 text-white shadow-xl scale-[1.02]');

                        selectedLetterBadge.removeClass('border-border-gray/50 text-cool-gray group-hover:border-blue-400 group-hover:text-blue-600 group-hover:bg-blue-50')
                                          .addClass('bg-white/20 border-white/40 text-white');

                        selectedText.removeClass('text-slate-navy group-hover:text-blue-700')
                                   .addClass('text-white');

                        selectedRadio.removeClass('border-border-gray/50 group-hover:border-blue-400 group-hover:bg-blue-50')
                                    .addClass('border-white bg-white')
                                    .html('<div class="w-4 h-4 bg-blue-600 rounded-full"></div>');

                        // Hide hover effect for selected
                        btn.find('.absolute').addClass('hidden');

                        // Auto advance after selection
                        setTimeout(() => {
                            if (currentIndex < soalItems.length - 1) {
                                nextBtn.click();
                            }
                        }, 800);
                    }
                },
                error: function (xhr) {
                    loadingOverlay.classList.add('hidden');
                    alert('Gagal menyimpan jawaban. Silakan coba lagi.');
                }
            });
        });

        // Initialize
        showSoal(currentIndex);

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>
</html>
