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
    public function index($formKuliahId, $attempt = null)
    {
        $formKuliah = FormKuliah::with(['minats', 'minats.jurusanKuliah'])->findOrFail($formKuliahId);

        $user = Auth::user();
        $namaSiswa = $user->siswa->nama_siswa ?? $user->name;
        $nilaiUtbk = $formKuliah->nilai_utbk;

        // Cek attempt terakhir user
        $activeAttempt = $attempt ?? $formKuliah->attempt;

        // 🔹 Pastikan data belum pernah disimpan sebelumnya
        $existingData = KenaliJurusan::where('user_id', $user->id)
            ->where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $attempt ?? $formKuliah->attempt)
            ->exists();

        $rekomUTBK = [];
        $rekomHobi = [];

        if (!$existingData) {

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

                    // 🔸 Cek dulu apakah data sudah ada
                    $exists = KenaliJurusan::where('user_id', $user->id)
                        ->where('jurusan_kuliah_id', $jurusan->id)
                        ->where('sumber_rekomendasi', 'utbk')
                        ->where('form_kuliah_id', $formKuliah->id)
                        ->exists();

                    if (!$exists) {
                        KenaliJurusan::create([
                            'user_id' => $user->id,
                            'jurusan_kuliah_id' => $jurusan->id,
                            'sumber_rekomendasi' => 'utbk',
                            'attempt' => $activeAttempt,
                            'form_kuliah_id' => $formKuliah->id,
                            'status_peluang' => $status,
                        ]);
                    }
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
                $exists = KenaliJurusan::where('user_id', $user->id)
                    ->where('jurusan_kuliah_id', $data['jurusan']->id)
                    ->where('sumber_rekomendasi', 'hobi')
                    ->where('attempt', $activeAttempt)
                    ->exists();

                if (!$exists) {
                    KenaliJurusan::create([
                        'user_id' => $user->id,
                        'jurusan_kuliah_id' => $data['jurusan']->id,
                        'sumber_rekomendasi' => 'hobi',
                        'attempt' => $activeAttempt,
                        'status_peluang' => null,
                    ]);
                }
            }
        } else {
            // 🟢 Jika data sudah ada, ambil ulang dari database (biar tampil di riwayat)
            $rekomUTBK = KenaliJurusan::with('jurusanKuliah.kampus')
                ->where('user_id', $user->id)
                ->where('form_kuliah_id', $formKuliah->id)
                ->where('attempt', $activeAttempt)
                ->where('sumber_rekomendasi', 'utbk')
                ->get()
                ->groupBy('jurusan_kuliah_id')
                ->map(function ($group) {
                    $jurusan = $group->first()->jurusanKuliah;
                    $kampusRekom = [];
                    foreach ($jurusan->kampus as $kampus) {
                        $passingGrade = $kampus->pivot->passing_grade ?? 0;
                        $persentase = $passingGrade > 0 ? (560 / $passingGrade) * 100 : 0;

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

                        $kampusRekom[] = [
                            'kampus' => $kampus,
                            'passing_grade' => $passingGrade,
                            'status' => $status,
                            'keterangan' => $keterangan,
                            'persentase' => round($persentase, 1),
                        ];
                    }
                    return [
                        'jurusan' => $jurusan,
                        'kampus' => $kampusRekom,
                    ];
                })
                ->values()
                ->toArray();

            $rekomHobi = KenaliJurusan::with('jurusanKuliah')
                ->where('user_id', $user->id)
                ->where('attempt', $activeAttempt)
                ->where('sumber_rekomendasi', 'hobi')
                ->get()
                ->map(function ($item) {
                    $jurusan = $item->jurusanKuliah;
                    $hobis = $jurusan->hobis->pluck('nama_hobi')->toArray();
                    $totalPoin = $jurusan->hobis->sum('pivot.poin'); // total poin dari relasi

                    return [
                        'jurusan' => $jurusan,
                        'total_poin' => $totalPoin,
                        'hobi_asal' => $hobis,
                    ];
                })
                ->sortByDesc('total_poin')
                ->values()
                ->toArray();
        }

        // ----------------------------
        // Return ke view gabungan
        // ----------------------------
        return view('siswa.pages.rekomendasi-jurusan', compact( 'namaSiswa', 'rekomUTBK', 'rekomHobi', 'nilaiUtbk'));
    }
}
