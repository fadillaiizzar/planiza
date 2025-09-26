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
                        <div class="soal-item {{ $index === 0 ? '' : 'hidden' }}" data-index="{{ $index }}">
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
                        btn.parent().find('.opsi-btn').each(function() {
                            const $this = $(this);
                            const letterBadge = $this.find('.w-12.h-12');
                            const optionText = $this.find('p');

                            $this.removeClass('bg-blue-600 border-blue-600 shadow-xl scale-[1.02]')
                                .addClass('bg-white hover:bg-blue-50 border-border-gray/30 hover:border-blue-300/50');

                            letterBadge.removeClass('bg-white/20 border-white/40 text-white')
                                    .addClass('border-border-gray/50 text-cool-gray group-hover:border-blue-400 group-hover:text-blue-600 group-hover:bg-blue-50');

                            optionText.removeClass('text-white')
                                    .addClass('text-slate-navy');

                            $this.find('.absolute').removeClass('hidden');
                        });

                        const selectedLetterBadge = btn.find('.w-12.h-12');
                        const selectedText = btn.find('p');

                        btn.removeClass('bg-white hover:bg-blue-50 border-border-gray/30 hover:border-blue-300/50')
                        .addClass('bg-blue-600 border-blue-600 shadow-xl scale-[1.02]');

                        selectedLetterBadge.removeClass('border-border-gray/50 text-cool-gray group-hover:border-blue-400 group-hover:text-blue-600 group-hover:bg-blue-50')
                                        .addClass('bg-white/20 border-white/40 text-white');

                        selectedText.removeClass('text-slate-navy')
                                    .addClass('text-white');

                        btn.find('.absolute').addClass('hidden');

                        setTimeout(() => {
                            if (currentIndex < soalItems.length - 1) {
                                nextBtn.click();
                            }
                        }, 800);
                    }
                },
                error: function () {
                    loadingOverlay.classList.add('hidden');
                    alert('Gagal menyimpan jawaban. Silakan coba lagi.');
                }
            });
        });

        showSoal(currentIndex);

        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>
</html>
