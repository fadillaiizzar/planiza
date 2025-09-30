<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Tes;
use App\Models\KenaliProfesi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RekomendasiProfesiController extends Controller
{
    public function index($tesId)
    {
        $tes = Tes::findOrFail($tesId);
        $user = Auth::user();
        $siswa = $user->siswa;

        // 🔹 Ambil semua jawaban siswa di tes ini
        $jawaban = $siswa->jawabanSiswa()
            ->with(['opsiJawaban.kategoriMinat.profesiKerjas', 'opsiJawaban.profesiKerja'])
            ->whereHas('soalTes', fn($q) => $q->where('tes_id', $tesId))
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

                    // alasan spesifik profesi
                    $alasanPerProfesi[$profesi->id][] = $opsi->isi_opsi;
                }
            }

            // 🔹 Multi choice: langsung ke profesi
            if ($opsi->profesi_kerja_id) {
                $poinProfesi[$opsi->profesi_kerja_id] = ($poinProfesi[$opsi->profesi_kerja_id] ?? 0) + $opsi->poin;

                // alasan spesifik profesi
                $alasanPerProfesi[$opsi->profesi_kerja_id][] = $opsi->isi_opsi;
            }
        }

        // 🔹 Simpan / update semua profesi
        foreach ($poinProfesi as $profesiId => $totalPoin) {
            KenaliProfesi::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'tes_id' => $tesId,
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
            ->orderByDesc('total_poin')
            ->get();

        // 🔹 Ambil 3 profesi poin tertinggi
        $topProfesi = $allProfesi->take(3);

        // 🔹 Buat alasan per profesi dalam kalimat
        $alasanFormatted = [];
        foreach ($alasanPerProfesi as $profesiId => $listAlasan) {
            $skills = implode(', ', array_unique($listAlasan));
            $alasanFormatted[$profesiId] = "Karena kemampuanmu di bidang $skills, profesi ini sangat sesuai untukmu.";
        }

        return view('siswa.pages.rekomendasi-profesi', compact(
            'tes', 'siswa', 'topProfesi', 'allProfesi', 'alasanFormatted'
        ));
    }
}
