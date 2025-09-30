<?php

namespace App\Http\Controllers\Siswa;

use App\Models\SoalTes;
use App\Models\OpsiJawaban;
use App\Models\JawabanSiswa;
use Illuminate\Http\Request;
use App\Models\KenaliProfesi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JawabanSiswaController extends Controller
{
    public function store(Request $request, $soalId)
    {
        $user = Auth::user();

        $request->validate([
            'opsi_jawaban_id' => 'required|array',
            'opsi_jawaban_id.*' => 'exists:opsi_jawabans,id',
        ]);

        $soal = SoalTes::findOrFail($soalId);
        $max = $soal->max_select;

        if (count($request->opsi_jawaban_id) > $max) {
            return response()->json([
                'success' => false,
                'message' => "Maksimal $max jawaban boleh dipilih"
            ], 422);
        }

        JawabanSiswa::where('user_id', $user->id)
            ->where('soal_tes_id', $soalId)
            ->whereNotIn('opsi_jawaban_id', $request->opsi_jawaban_id)
            ->delete();

        foreach ($request->opsi_jawaban_id as $opsiId) {
            JawabanSiswa::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'soal_tes_id' => $soalId,
                    'opsi_jawaban_id' => $opsiId,
                ],
                [
                    'tes_id' => $soal->tes_id,
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil disimpan',
            'jenis_soal' => $max == 1 ? 'single' : 'multi',
            'max' => $max
        ]);
    }
}
