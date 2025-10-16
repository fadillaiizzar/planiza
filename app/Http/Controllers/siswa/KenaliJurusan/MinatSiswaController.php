<?php

namespace App\Http\Controllers\Siswa\KenaliJurusan;

use App\Models\Minat;
use App\Models\FormKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MinatSiswaController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id();

        $formKuliah = FormKuliah::firstOrCreate(['user_id' => $userId]);

        $attempt = $request->input('attempt', 1);

        $minat = Minat::updateOrCreate(
            [
                'form_kuliah_id' => $formKuliah->id,
                'attempt' => $attempt,
            ],
            [
                'nilai_utbk' => $request->nilai_utbk ?? 0,
                'jurusan_kuliah_ids' => json_encode($request->jurusan_kuliah_ids ?? []),
                'hobi_ids' => json_encode($request->hobi_ids ?? []),
                'is_finished' => false,
            ]
        );

        $formKuliah->update(['nilai_utbk' => $request->nilai_utbk ?? 0]);

        return response()->json([
            'success' => true,
            'message' => 'Data tersimpan sementara.',
        ]);
    }

    public function submit(Request $request)
    {
        $userId = Auth::id();
        $formKuliah = FormKuliah::where('user_id', $userId)->firstOrFail();

        $attempt = $request->input('attempt');

        Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $attempt)
            ->update([
                'is_finished' => true,
            ]);

        return redirect()->route('siswa.kenali-jurusan.index')
            ->with('success', 'Data form kuliah kamu berhasil dikirim!');
    }
}
