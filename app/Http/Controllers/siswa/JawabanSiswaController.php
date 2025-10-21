<?php

namespace App\Http\Controllers\Siswa;

use App\Models\SoalTes;
use App\Models\JawabanSiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JawabanSiswaController extends Controller
{
    public function store(Request $request, $soalId)
    {
        $user = Auth::user();

        // 🔹 Ambil data soal
        $soal = SoalTes::findOrFail($soalId);
        $max = $soal->max_select;

        $activeAttempt = $request->input('attempt', 1);
        $jawabanArray = $request->input('opsi_jawaban_id', []);

        // validasi max
        if (count($jawabanArray) > $max) {
            return response()->json([
                'success' => false,
                'message' => "Maksimal $max jawaban boleh dipilih"
            ], 422);
        }

        if ($max == 1) {
            // 🔹 Soal pilihan tunggal (radio)
            JawabanSiswa::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'soal_tes_id' => $soalId,
                    'tes_id' => $soal->tes_id,
                    'attempt' => $activeAttempt,
                ],
                [
                    'opsi_jawaban_id' => $jawabanArray[0] ?? null,
                    'is_finished' => false,
                ]
            );
        } else {
            // 🔹 Soal pilihan ganda (checkbox) → hapus jawaban lama yang tidak ada di array
            $currentAnswers = JawabanSiswa::where('user_id', $user->id)
                ->where('soal_tes_id', $soalId)
                ->where('tes_id', $soal->tes_id)
                ->where('attempt', $activeAttempt)
                ->pluck('opsi_jawaban_id')
                ->toArray();

            $toDelete = array_diff($currentAnswers, $jawabanArray);
            JawabanSiswa::where('user_id', $user->id)
                ->where('soal_tes_id', $soalId)
                ->where('tes_id', $soal->tes_id)
                ->where('attempt', $activeAttempt)
                ->whereIn('opsi_jawaban_id', $toDelete)
                ->delete();

            $toAdd = array_diff($jawabanArray, $currentAnswers);
            foreach ($toAdd as $opsiId) {
                JawabanSiswa::create([
                    'user_id' => $user->id,
                    'soal_tes_id' => $soalId,
                    'tes_id' => $soal->tes_id,
                    'opsi_jawaban_id' => $opsiId,
                    'attempt' => $activeAttempt,
                    'is_finished' => false,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil disimpan',
            'max' => $max,
            'jawaban' => $jawabanArray
        ]);
    }
}
