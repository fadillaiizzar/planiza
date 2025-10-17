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

        // 🔹 Validasi input jawaban harus array dan id opsi valid
        $request->validate([
            'opsi_jawaban_id' => 'required|array',
            'opsi_jawaban_id.*' => 'exists:opsi_jawabans,id',
        ]);

        // 🔹 Ambil data soal
        $soal = SoalTes::findOrFail($soalId);
        $max = $soal->max_select;

        // 🔹 Jika siswa memilih lebih dari batas, kirim error
        if (count($request->opsi_jawaban_id) > $max) {
            return response()->json([
                'success' => false,
                'message' => "Maksimal $max jawaban boleh dipilih"
            ], 422);
        }

        $activeAttempt = $request->input('attempt', 1);

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
                    'opsi_jawaban_id' => $request->opsi_jawaban_id[0],
                    'is_finished' => false,
                ]
            );
        } else {
            // 🔹 Soal pilihan ganda (checkbox)
            $currentAnswers = JawabanSiswa::where('user_id', $user->id)
                ->where('soal_tes_id', $soalId)
                ->where('tes_id', $soal->tes_id)
                ->where('attempt', $activeAttempt)
                ->pluck('opsi_jawaban_id')
                ->toArray();

            foreach ($request->opsi_jawaban_id as $opsiId) {
                if (in_array($opsiId, $currentAnswers)) {
                    continue; // sudah ada, skip
                }

                if (count($currentAnswers) >= $max) {
                    // kalau sudah penuh max → hapus jawaban lama paling awal
                    $jawabanLama = JawabanSiswa::where('user_id', $user->id)
                        ->where('soal_tes_id', $soalId)
                        ->where('tes_id', $soal->tes_id)
                        ->where('attempt', $activeAttempt)
                        ->oldest()
                        ->first();

                    if ($jawabanLama) {
                        $jawabanLama->delete();
                        array_shift($currentAnswers);
                    }
                }

                // simpan jawaban baru
                JawabanSiswa::create([
                    'user_id' => $user->id,
                    'soal_tes_id' => $soalId,
                    'opsi_jawaban_id' => $opsiId,
                    'tes_id' => $soal->tes_id,
                    'attempt' => $activeAttempt,
                    'is_finished' => false,
                ]);

                $currentAnswers[] = $opsiId;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil disimpan',
            'jenis_soal' => $max == 1 ? 'single' : 'multi',
            'max' => $max
        ]);
    }
}
