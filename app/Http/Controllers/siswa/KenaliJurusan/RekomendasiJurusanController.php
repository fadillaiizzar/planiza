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
                $persen = $passingGrade ? ($nilaiUtbk / $passingGrade) * 100 : 0;

                if ($persen >= 80) $status = 'Tinggi';
                elseif ($persen >= 60) $status = 'Sedang';
                else $status = 'Rendah';

                $kampusRekom[] = [
                    'kampus' => $kampus,
                    'passing_grade' => $passingGrade,
                    'status' => ucfirst($status),
                    'selisih' => $nilaiUtbk - $passingGrade,
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

            usort($kampusRekom, fn($a,$b)=>$b['selisih'] <=> $a['selisih']);

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
        return view('siswa.pages.rekomendasi-jurusan', compact('rekomUTBK', 'rekomHobi', 'nilaiUtbk'));
    }
}
