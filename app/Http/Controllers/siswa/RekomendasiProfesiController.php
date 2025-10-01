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

        $activeAttempt = $attempt ?? JawabanSiswa::where('user_id', $user->id)
        ->where('tes_id', $tesId)
        ->max('attempt');

        $jawaban = $siswa->jawabanSiswa()
            ->with(['opsiJawaban.kategoriMinat.profesiKerjas', 'opsiJawaban.profesiKerja'])
            ->where('tes_id', $tesId)
            ->where('attempt', $activeAttempt)
            ->get();

        $poinProfesi = [];
        $alasanPerProfesi = [];

        foreach ($jawaban as $jwb) {
            $opsi = $jwb->opsiJawaban;
            if (!$opsi) continue;

            // 🔹 Single choice: lewat kategori → profesi
            if ($opsi->kategoriMinat) {
                foreach ($opsi->kategoriMinat->profesiKerjas as $profesi) {
                    $poinProfesi[$profesi->id] = ($poinProfesi[$profesi->id] ?? 0) + $opsi->poin;

                    $alasanPerProfesi[$profesi->id][] = $opsi->isi_opsi;
                }
            }

            // 🔹 Multi choice: langsung ke profesi
            if ($opsi->profesi_kerja_id) {
                $poinProfesi[$opsi->profesi_kerja_id] = ($poinProfesi[$opsi->profesi_kerja_id] ?? 0) + $opsi->poin;

                $alasanPerProfesi[$opsi->profesi_kerja_id][] = $opsi->isi_opsi;
            }
        }

        // 🔹 Simpan / update semua profesi
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

        // 🔹 Ambil semua profesi urut poin
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

        return view('siswa.pages.rekomendasi-profesi', compact(
            'tes', 'siswa', 'topProfesi', 'allProfesi', 'alasanFormatted', 'activeAttempt'
        ));
    }
}
