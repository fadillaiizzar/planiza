<?php

namespace App\Http\Controllers\Siswa\KenaliJurusan;

use App\Models\Hobi;
use App\Models\FormKuliah;
use App\Models\JurusanKuliah;
use App\Models\KenaliJurusan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RekomendasiJurusanController extends Controller
{
    public function index($formKuliahId)
    {
        $formKuliah = FormKuliah::with(['minats', 'minats.jurusanKuliah'])->findOrFail($formKuliahId);

        $user = Auth::user();
        $namaSiswa = $user->siswa->nama_siswa ?? $user->name;

        $nilaiUtbk = $formKuliah->nilai_utbk;

        // Cek attempt terakhir user
        $activeAttempt = KenaliJurusan::where('user_id', $user->id)->max('attempt') + 1;

        // ----------------------------
        // 1️⃣ Rekomendasi UTBK + Jurusan
        // ----------------------------
        $jurusanSelected = $formKuliah->minats->pluck('jurusan_kuliah_id')->filter()->toArray();
        $rekomUTBK = [];

        foreach ($jurusanSelected as $jurusanId) {
            $jurusan = JurusanKuliah::find($jurusanId);
            if (!$jurusan) continue;

            $kampusList = $jurusan->kampus()->get();
            $kampusRekom = [];

            foreach ($kampusList as $kampus) {
                $passingGrade = $kampus->pivot->passing_grade ?? 0;

                // 🔹 Logika status peluang berdasarkan perbandingan UTBK vs Passing Grade
                if ($passingGrade == 0) {
                    $keterangan = 'Data passing grade belum tersedia untuk kampus ini.';
                } else {
                    $persentase = ($nilaiUtbk / $passingGrade) * 100;

                    if ($persentase >= 100) {
                        $status = 'Tinggi';
                        $keterangan = 'Nilai kamu sudah melebihi Passing Grade 🎉';
                    } elseif ($persentase >= 80) {
                        $status = 'Sedang';
                        $keterangan = 'Nilai kamu mendekati Passing Grade, masih ada peluang!';
                    } else {
                        $status = 'Rendah';
                        $keterangan = 'Nilai kamu masih jauh dari Passing Grade, perlu ditingkatkan.';
                    }
                }

                $kampusRekom[] = [
                    'kampus' => $kampus,
                    'passing_grade' => $passingGrade,
                    'status' => $status,
                    'keterangan' => $keterangan,
                    'persentase' => round($persentase ?? 0, 1),
                ];

                // 🔸 Simpan ke tabel kenali_jurusans
                KenaliJurusan::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'jurusan_kuliah_id' => $jurusan->id,
                        'sumber_rekomendasi' => 'utbk',
                        'attempt' => $activeAttempt,
                        'form_kuliah_id' => $formKuliah->id,
                    ],
                    [
                        'status_peluang' => $status,
                    ]
                );
            }

            usort($kampusRekom, fn($a, $b) => $b['persentase'] <=> $a['persentase']);

            $rekomUTBK[] = [
                'jurusan' => $jurusan,
                'kampus' => $kampusRekom,
            ];
        }

        // ----------------------------
        // 2️⃣ Rekomendasi Berdasarkan Hobi
        // ----------------------------
        $hobiSelected = $formKuliah->minats->pluck('hobi_id')->filter()->toArray();
        $jurusanPoin = [];

        $hobis = Hobi::with('jurusanKuliahs')->whereIn('id', $hobiSelected)->get();

        foreach ($hobis as $hobi) {
            foreach ($hobi->jurusanKuliahs as $jurusan) {
                $poin = $jurusan->pivot->poin;
                $jurusanPoin[$jurusan->id]['jurusan'] = $jurusan;
                $jurusanPoin[$jurusan->id]['total_poin'] = ($jurusanPoin[$jurusan->id]['total_poin'] ?? 0) + $poin;
                $jurusanPoin[$jurusan->id]['hobi_asal'][] = $hobi->nama_hobi;
            }
        }

        // Urutkan jurusan berdasarkan total poin tertinggi
        $rekomHobi = collect($jurusanPoin)->sortByDesc('total_poin')->values()->toArray();

        // 🔹 Simpan ke tabel kenali_jurusans (sumber = hobi)
        foreach ($rekomHobi as $data) {
            KenaliJurusan::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'jurusan_kuliah_id' => $data['jurusan']->id,
                    'sumber_rekomendasi' => 'hobi',
                    'attempt' => $activeAttempt,
                ],
                [
                    'status_peluang' => null,
                ]
            );
        }

        // ----------------------------
        // Return ke view gabungan
        // ----------------------------
        return view('siswa.pages.rekomendasi-jurusan', compact( 'namaSiswa', 'rekomUTBK', 'rekomHobi', 'nilaiUtbk'));
    }
}
