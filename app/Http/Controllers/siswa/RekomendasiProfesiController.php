<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Tes;
use App\Models\SoalTes;
use App\Models\JawabanSiswa;
use App\Models\KenaliProfesi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RekomendasiProfesiController extends Controller
{
    public function index($tesId, $attempt = null)
    {
        $tes = Tes::findOrFail($tesId);
        $user = Auth::user();
        $siswa = $user->siswa;

        // 🔹 Tentukan attempt aktif (pakai parameter atau ambil max attempt)
        $activeAttempt = $attempt ?? JawabanSiswa::where('user_id', $user->id)
        ->where('tes_id', $tesId)
        ->max('attempt');

        // 🔹 Ambil semua jawaban di attempt ini, lengkap dengan relasi opsi → kategori → profesi
        $jawaban = $siswa->jawabanSiswa()
            ->with(['opsiJawaban.kategoriMinat.profesiKerjas', 'opsiJawaban.profesiKerja', 'opsiJawaban.soalTes'])
            ->where('tes_id', $tesId)
            ->where('attempt', $activeAttempt)
            ->get();

        // total poin dan alasan opsi per profesi
        $poinProfesi = [];
        $alasanPerProfesi = [];

        // total soal single dan multi
        $totalSingle = SoalTes::where('jenis_soal', 'single')->count();
        $totalMulti = SoalTes::where('jenis_soal', 'multi')->count();

        // bobot global
        $bobotSingle = 30;
        $bobotMulti = 70;

        foreach ($jawaban as $jwb) {
            $opsi = $jwb->opsiJawaban;
            if (!$opsi) continue;

            $soal = $opsi->soalTes;

            // 🔹 Soal Single
            if ($soal->jenis_soal === 'single' && $opsi->kategoriMinat) {
                $jumlahProfesi = $opsi->kategoriMinat->profesiKerjas->count();
                $poinPerProfesi = ($bobotSingle / max($totalSingle, 1)) / max($jumlahProfesi, 1);

                foreach ($opsi->kategoriMinat->profesiKerjas as $profesi) {
                    $poinProfesi[$profesi->id] = ($poinProfesi[$profesi->id] ?? 0) + $poinPerProfesi;
                    $alasanPerProfesi[$profesi->id][] = $opsi->isi_opsi;
                }
            }

            // 🔹 Soal Multi
            if ($soal->jenis_soal === 'multi' && $opsi->profesi_kerja_id) {
                $jumlahJawabanSiswa = $jawaban
                    ->filter(fn($j) => $j->opsiJawaban->soal_tes_id === $soal->id)
                    ->count();

                $poinPerProfesi = ( ($bobotMulti / max($totalMulti, 1)) * 1.2 ) / max($jumlahJawabanSiswa, 1);

                $poinProfesi[$opsi->profesi_kerja_id] = ($poinProfesi[$opsi->profesi_kerja_id] ?? 0) + $poinPerProfesi;
                $alasanPerProfesi[$opsi->profesi_kerja_id][] = $opsi->isi_opsi;
            }
        }

        // 🔹 Simpan hasil poin ke tabel kenali_profesi
        foreach ($poinProfesi as $profesiId => $totalPoin) {
            KenaliProfesi::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'tes_id' => $tesId,
                    'attempt' => $activeAttempt,
                    'profesi_kerja_id' => $profesiId,
                    'sumber_rekomendasi' => 'tes'
                ],
                [
                    'total_poin' => $totalPoin
                ]
            );
        }

        // 🔹 Ambil semua profesi hasil tes (urut dari poin tertinggi)
        $allProfesi = KenaliProfesi::with('profesiKerja')
            ->where('user_id', $user->id)
            ->where('tes_id', $tesId)
            ->where('attempt', $activeAttempt)
            ->orderByDesc('total_poin')
            ->get();

        // 🔹 Hitung ranking manual dengan memperhatikan tie (skor sama)
        $rank = 1;
        $prevScore = null;
        $tieCount = 0;

        foreach ($allProfesi as $index => $profesi) {
            if ($prevScore !== null && $profesi->total_poin < $prevScore) {
                $rank += $tieCount;
                $tieCount = 1;
            } else {
                $tieCount++;
            }

            $profesi->update(['ranking' => $rank]);
            $prevScore = $profesi->total_poin;
        }

        // 🔹 Tentukan 3 besar + deteksi tie di posisi ke-3
        $top3 = $allProfesi->where('ranking', '<=', 3);
        $minTop3Score = $top3->last()->total_poin ?? 0;

        // cek ada yang skornya sama dengan posisi ke-3
        $tiedWithThird = $allProfesi->filter(fn($p) =>
            $p->total_poin === $minTop3Score && $p->ranking > 3
        );

        $extraCount = $tiedWithThird->count();

        // gabungkan ke koleksi tampilan (3 utama + tie kalau ada)
        $topProfesi = $extraCount > 0
            ? $allProfesi->filter(fn($p) => $p->total_poin >= $minTop3Score)
            : $top3;

        // 🔹 Buat alasan per profesi dalam kalimat
        $alasanFormatted = [];
        foreach ($alasanPerProfesi as $profesiId => $listAlasan) {
            $skills = implode(', ', array_unique($listAlasan));
            $alasanFormatted[$profesiId] = "Karena kemampuanmu di bidang $skills, profesi ini sangat sesuai untukmu";
        }

        // 🔹 Kirim semua data ke view hasil rekomendasi
        return view('siswa.pages.rekomendasi-profesi', compact(
            'tes', 'siswa', 'topProfesi', 'allProfesi', 'alasanFormatted', 'activeAttempt'
        ));
    }
}
