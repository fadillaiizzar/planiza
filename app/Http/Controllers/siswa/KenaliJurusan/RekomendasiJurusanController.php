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
        $activeAttempt = $attempt ?? $formKuliah->attempt;

        $existingData = KenaliJurusan::where('user_id', $user->id)
            ->where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $activeAttempt)
            ->exists();

        if (!$existingData) {
            $rekomUTBK = $this->generateRekomendasiUTBK($formKuliah, $user, $nilaiUtbk, $activeAttempt);
            $rekomHobi = $this->generateRekomendasiHobi($formKuliah, $user, $activeAttempt);
        } else {
            $rekomUTBK = $this->ambilRiwayatUTBK($user, $formKuliah, $activeAttempt, $nilaiUtbk);
            $rekomHobi = $this->ambilRiwayatHobi($user, $activeAttempt);
        }

        return view('siswa.pages.rekomendasi-jurusan', compact('namaSiswa', 'rekomUTBK', 'rekomHobi', 'nilaiUtbk'));
    }

    // =========================================================
    // 🔹 PRIVATE FUNCTION: Generate rekomendasi berdasarkan UTBK
    // =========================================================
    private function generateRekomendasiUTBK($formKuliah, $user, $nilaiUtbk, $activeAttempt)
    {
        $jurusanSelected = $formKuliah->minats->pluck('jurusan_kuliah_id')->filter()->toArray();
        $rekomUTBK = [];

        foreach ($jurusanSelected as $jurusanId) {
            $jurusan = JurusanKuliah::find($jurusanId);
            if (!$jurusan) continue;

            $kampusList = $jurusan->kampus()->get();
            $kampusRekom = [];

            foreach ($kampusList as $kampus) {
                $passingGrade = $kampus->pivot->passing_grade ?? 0;

                if ($passingGrade == 0) {
                    $status = '-';
                    $keterangan = 'Data passing grade belum tersedia untuk kampus ini.';
                    $persentase = 0;
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
                    'persentase' => round($persentase, 1),
                ];

                // Simpan jika belum ada
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

        return $rekomUTBK;
    }

    // =========================================================
    // 🔹 PRIVATE FUNCTION: Generate rekomendasi berdasarkan Hobi
    // =========================================================
    private function generateRekomendasiHobi($formKuliah, $user, $activeAttempt)
    {
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

        $rekomHobi = collect($jurusanPoin)->sortByDesc('total_poin')->values()->toArray();

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

        return $rekomHobi;
    }

    // =========================================================
    // 🔹 PRIVATE FUNCTION: Ambil riwayat rekomendasi UTBK
    // =========================================================
    private function ambilRiwayatUTBK($user, $formKuliah, $activeAttempt, $nilaiUtbk)
    {
        return KenaliJurusan::with('jurusanKuliah.kampus')
            ->where('user_id', $user->id)
            ->where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $activeAttempt)
            ->where('sumber_rekomendasi', 'utbk')
            ->get()
            ->groupBy('jurusan_kuliah_id')
            ->map(function ($group) use ($nilaiUtbk) {
                $jurusan = $group->first()->jurusanKuliah;
                $kampusRekom = [];

                foreach ($jurusan->kampus as $kampus) {
                    $passingGrade = $kampus->pivot->passing_grade ?? 0;
                    $persentase = $passingGrade > 0 ? ($nilaiUtbk / $passingGrade) * 100 : 0;

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
    }

    // =========================================================
    // 🔹 PRIVATE FUNCTION: Ambil riwayat rekomendasi Hobi
    // =========================================================
    private function ambilRiwayatHobi($user, $activeAttempt)
    {
        return KenaliJurusan::with('jurusanKuliah.hobis')
            ->where('user_id', $user->id)
            ->where('attempt', $activeAttempt)
            ->where('sumber_rekomendasi', 'hobi')
            ->get()
            ->map(function ($item) {
                $jurusan = $item->jurusanKuliah;
                $hobis = $jurusan->hobis->pluck('nama_hobi')->toArray();
                $totalPoin = $jurusan->hobis->sum('pivot.poin');

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
}
