<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Tes;
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
            ->with(['opsiJawaban.kategoriMinat.profesiKerjas', 'opsiJawaban.profesiKerja'])
            ->where('tes_id', $tesId)
            ->where('attempt', $activeAttempt)
            ->get();

        // total poin dan alasan opsi per profesi
        $poinProfesi = [];
        $alasanPerProfesi = [];

        foreach ($jawaban as $jwb) {
            $opsi = $jwb->opsiJawaban;
            if (!$opsi) continue;

            // 🔹 Kalau opsi punya kategori minat → setiap profesi di kategori itu mendapat poin
            if ($opsi->kategoriMinat) {
                foreach ($opsi->kategoriMinat->profesiKerjas as $profesi) {
                    $poinProfesi[$profesi->id] = ($poinProfesi[$profesi->id] ?? 0) + $opsi->poin;

                    $alasanPerProfesi[$profesi->id][] = $opsi->isi_opsi;
                }
            }

            // 🔹 Kalau opsi langsung mengarah ke profesi (tanpa kategori)
            if ($opsi->profesi_kerja_id) {
                $poinProfesi[$opsi->profesi_kerja_id] = ($poinProfesi[$opsi->profesi_kerja_id] ?? 0) + $opsi->poin;

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

        // 🔹 Ambil 3 profesi poin tertinggi
        $topProfesi = $allProfesi->take(3);

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
