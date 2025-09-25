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

        $request->validate([
            'opsi_jawaban_id' => 'required|exists:opsi_jawabans,id',
        ]);

        $soal = SoalTes::findOrFail($soalId);

        JawabanSiswa::updateOrCreate(
            [
                'user_id' => $user->id,
                'soal_tes_id' => $soalId,
            ],
            [
                'tes_id' => $soal->tes_id,
                'opsi_jawaban_id' => $request->opsi_jawaban_id
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil disimpan'
        ]);
    }
}
