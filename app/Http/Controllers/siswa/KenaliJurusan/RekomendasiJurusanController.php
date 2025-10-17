<?php

namespace App\Http\Controllers\Siswa\KenaliJurusan;

use App\Models\Hobi;
use App\Models\FormKuliah;
use App\Models\JurusanKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RekomendasiJurusanController extends Controller
{
    public function index($formKuliahId)
    {
        $formKuliah = FormKuliah::with('minats')->findOrFail($formKuliahId);
        $user = Auth::user();
        $nilaiUtbk = $formKuliah->nilai_utbk;

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
                $persen = $passingGrade ? ($nilaiUtbk / $passingGrade) * 100 : 0;

                if ($persen >= 80) $status = 'Tinggi';
                elseif ($persen >= 60) $status = 'Sedang';
                else $status = 'Rendah';

                $kampusRekom[] = [
                    'kampus' => $kampus,
                    'passing_grade' => $passingGrade,
                    'status' => $status,
                    'selisih' => $nilaiUtbk - $passingGrade
                ];
            }

            usort($kampusRekom, fn($a,$b)=>$b['selisih'] <=> $a['selisih']);

            $rekomUTBK[] = [
                'jurusan' => $jurusan,
                'kampus' => $kampusRekom
            ];
        }

        // ----------------------------
        // 2️⃣ Rekomendasi Berdasarkan Hobi
        // ----------------------------
        $hobiSelected = $formKuliah->minats->pluck('hobi_id')->filter()->toArray();
        $jurusanPoin = [];

        foreach ($hobiSelected as $hobiId) {
            $hobi = Hobi::find($hobiId);
            if (!$hobi) continue;

            foreach ($hobi->jurusanKuliahs()->withPivot('poin')->get() as $jurusan) {
                $poin = $jurusan->pivot->poin;
                $jurusanPoin[$jurusan->id]['jurusan'] = $jurusan;
                $jurusanPoin[$jurusan->id]['total_poin'] = ($jurusanPoin[$jurusan->id]['total_poin'] ?? 0) + $poin;
            }
        }

        // Urutkan jurusan berdasarkan total poin tertinggi
        $rekomHobi = array_values(
            collect($jurusanPoin)->sortByDesc('total_poin')->toArray()
        );

        // ----------------------------
        // Return ke view gabungan
        // ----------------------------
        return view('siswa.pages.rekomendasi-jurusan', compact('rekomUTBK', 'rekomHobi', 'nilaiUtbk'));
    }
}
