<?php

namespace App\Http\Controllers\Siswa\KenaliJurusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Minat;

class MinatSiswaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nilai_utbk' => 'required|numeric|min:0',
            'jurusan_kuliah_ids' => 'required|array|max:3',
            'jurusan_kuliah_ids.*' => 'exists:jurusan_kuliahs,id',
            'hobi_ids' => 'required|array|max:3',
            'hobi_ids.*' => 'exists:hobi_jurusans,id',
            'attempt' => 'required|integer|min:1'
        ]);

        $userId = Auth::id();
        $attempt = $request->attempt;

        // Simpan jawaban user
        Minat::create([
            'user_id' => $userId,
            'nilai_utbk' => $request->nilai_utbk,
            'jurusan_kuliah_ids' => json_encode($request->jurusan_kuliah_ids),
            'hobi_ids' => json_encode($request->hobi_ids),
            'attempt' => $attempt,
            'is_finished' => false, 
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jawaban form berhasil disimpan.',
        ]);
    }
}
