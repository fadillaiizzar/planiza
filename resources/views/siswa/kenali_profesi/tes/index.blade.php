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
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-40 w-80 h-80 bg-purple-500/5 rounded-full blur-3xl"></div>
    </div>

    @include('siswa.kenali_profesi.tes.progress-bar',
        [
            'tes' => $tes,
            'soals' => $soals
        ]
    )

    <main class="relative z-10 pt-32 pb-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">

            <!-- Test Container -->
            <div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border border-white/20 p-6 sm:p-8 lg:p-12">
                <div id="soal-container" class="min-h-[400px]">
                    @foreach ($soals as $index => $soal)
                        <div class="soal-item {{ $index === 0 ? '' : 'hidden' }}" data-index="{{ $index }}" data-id="{{ $soal->id }}" data-max="{{ $soal->max_select }}">
                            @include('siswa.kenali_profesi.tes.question-header',
                                [
                                    'index' => $index,
                                    'soal' => $soal
                                ]
                            )

                            @include('siswa.kenali_profesi.tes.answer-options',
                                [
                                    'soal' => $soal
                                ]
                            )
                        </div>
                    @endforeach
                </div>

                @include('siswa.kenali_profesi.tes.navigation')
            </div>
        </div>
    </main>

    @include('siswa.kenali_profesi.tes.loading')

    @include('siswa.kenali_profesi.tes.popup-custom')

    <input type="hidden" id="activeAttempt" value="{{ $activeAttempt }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const answeredSoal = {
            @foreach($soals as $soal)
                '{{ $soal->id }}': @json($soal->jawabanSiswa ? $soal->jawabanSiswa->pluck('opsi_jawaban_id') : []),
            @endforeach
        };

        const soalItems = document.querySelectorAll('.soal-item');
        let currentIndex = 0;

        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitForm = document.getElementById('submit-form');
        const progressBar = document.getElementById('progress-bar');
        const questionCounter = document.getElementById('question-counter');
        const loadingOverlay = document.getElementById('loading-overlay');
        const totalSoal = soalItems.length;

        // 🔹 Update progress bar + counter
        function updateProgress() {
            const progress = ((currentIndex + 1) / totalSoal) * 100;
            progressBar.style.width = `${progress}%`;
            questionCounter.textContent = `${currentIndex + 1} / ${totalSoal}`;
        }

        // 🔹 Tampilkan soal ke-n
        function showSoal(index) {
            soalItems.forEach((item, i) => item.classList.toggle('hidden', i !== index));
            prevBtn.disabled = index === 0;
            nextBtn.classList.toggle('hidden', index === totalSoal - 1);
            submitForm.classList.toggle('hidden', index !== totalSoal - 1);
            updateProgress();

            const soalId = soalItems[index].dataset.id;
            const selectedOpsi = answeredSoal[soalId] || [];

            $(soalItems[index]).find('.opsi-btn').each(function () {
                const opsiId = $(this).data('opsi');
                if (selectedOpsi.includes(opsiId)) {
                    setSelectedOptionStyles($(this));
                } else {
                    resetOptionStyles($(this));
                }
            });
        }

        // 🔹 Navigasi soal
        prevBtn.onclick = () => { if (currentIndex > 0) showSoal(--currentIndex); };

        // 🔹 Tambahan validasi di tombol next
        nextBtn.onclick = () => {
            const soalId = soalItems[currentIndex].dataset.id;
            if (!answeredSoal[soalId] || answeredSoal[soalId].length === 0) {
                showCustomAlert('Harap pilih jawaban terlebih dahulu sebelum lanjut.');
                return;
            }
            if (currentIndex < totalSoal - 1) showSoal(++currentIndex);
        };

        // 🔹 Tambahan keyboard
        document.addEventListener('keydown', e => {
            if (e.code === 'ArrowLeft') prevBtn.click();
            if (e.code === 'ArrowRight' || e.code === 'Space') nextBtn.click();
        });

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

        // 🔹 Tambahan Popup
        function showCustomAlert(message) {
            document.getElementById('custom-alert-message').textContent = message;
            document.getElementById('custom-alert').classList.remove('hidden');
        }

        function hideCustomAlert() {
            document.getElementById('custom-alert').classList.add('hidden');
        }

        // 🔹 Reset semua opsi ke default
        function resetOptionStyles($btn) {
            const badge = $btn.find('.w-12.h-12');
            const text = $btn.find('p');

            $btn.removeClass('bg-slate-navy border-slate-navy shadow-xl scale-[1.02]')
                .addClass('bg-white hover:bg-blue-50 border-border-gray/30 hover:border-blue-300/50');

            badge.removeClass('bg-white/20 border-white/40 text-white')
                .addClass('border-border-gray/50 text-cool-gray group-hover:border-blue-400 group-hover:text-slate-navy group-hover:bg-blue-50');

            text.removeClass('text-white')
                .addClass('text-slate-navy');

            $btn.find('.absolute').removeClass('hidden');
        }

        // 🔹 Set opsi terpilih
        function setSelectedOptionStyles($btn) {
            const badge = $btn.find('.w-12.h-12');
            const text = $btn.find('p');

            $btn.removeClass('bg-white hover:bg-blue-50 border-border-gray/30 hover:border-blue-300/50')
                .addClass('bg-slate-navy border-slate-navy shadow-xl scale-[1.02]');

            badge.removeClass('border-border-gray/50 text-cool-gray group-hover:border-blue-400 group-hover:text-slate-navy group-hover:bg-blue-50')
                .addClass('bg-white/20 border-white/40 text-white');

            text.removeClass('text-slate-navy')
                .addClass('text-white');

            $btn.find('.absolute').addClass('hidden');
        }

        // 🔹 Event Pilih opsi jawaban
        $(document).on('click', '.opsi-btn', function () {
            const soalId = $(this).data('soal');
            const opsiId = $(this).data('opsi');
            const btn = $(this);
            const soalItem = $(this).closest('.soal-item');
            const maxSelect = parseInt(soalItem.data('max'));

            loadingOverlay.classList.remove('hidden');

            // toggle multi select
            if (!answeredSoal[soalId]) {
                answeredSoal[soalId] = [];
            }

            if (maxSelect === 1) {
                answeredSoal[soalId] = [opsiId];
            } else {
                const idx = answeredSoal[soalId].indexOf(opsiId);

                if (idx === -1) {
                    if (answeredSoal[soalId].length < maxSelect) {
                        answeredSoal[soalId].push(opsiId);
                    } else {
                        answeredSoal[soalId].shift();
                        answeredSoal[soalId].push(opsiId);
                    }
                } else {
                    answeredSoal[soalId].splice(idx, 1);
                }
            }

            $.ajax({
                url: `/siswa/kenali-profesi/tes/${soalId}/jawab`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    opsi_jawaban_id: answeredSoal[soalId],
                    attempt: $('#activeAttempt').val()
                },
                success: function (res) {
                    loadingOverlay.classList.add('hidden');

                    if (res.success) {
                        btn.parent().find('.opsi-btn').each(function () {
                            const opsi = $(this).data('opsi');
                            if (answeredSoal[soalId].includes(opsi)) {
                                setSelectedOptionStyles($(this));
                            } else {
                                resetOptionStyles($(this));
                            }
                        });

                        if (res.jenis_soal === "single") {
                            setTimeout(() => {
                                if (currentIndex < soalItems.length - 1) {
                                    nextBtn.click();
                                }
                            }, 800);
                        }
                    }
                },
                error: function () {
                    loadingOverlay.classList.add('hidden');
                    showCustomAlert('Gagal menyimpan jawaban. Silakan coba lagi.');
                }
            });
        });

        showSoal(currentIndex);

        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>
</html>
