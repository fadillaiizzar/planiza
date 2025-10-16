<?php

namespace App\Http\Controllers\Siswa\KenaliJurusan;

use App\Models\Minat;
use App\Models\FormKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MinatSiswaController extends Controller
{
    public function store(Request $request, FormKuliah $formKuliah)
    {
        $userId = Auth::id();
        if ($formKuliah->user_id !== $userId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $attempt = (int) $request->input('attempt', 1);
        $jurusanIds = (array) $request->input('jurusan_kuliah_ids', []);
        $hobiIds = (array) $request->input('hobi_ids', []);
        $nilaiUtbk = (int) $request->input('nilai_utbk', 0);

        // Pastikan attempt juga disimpan di form_kuliahs
        $formKuliah->update([
            'attempt' => $attempt,
            'nilai_utbk' => $nilaiUtbk,
        ]);

        // Hapus data lama untuk attempt yang sama
        Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $attempt)
            ->delete();

        // Looping gabungan jurusan dan hobi seperti yang kamu minta
        $maxCount = max(count($jurusanIds), count($hobiIds));

        for ($i = 0; $i < $maxCount; $i++) {
            $jurusanId = $jurusanIds[$i] ?? null;
            $hobiId = $hobiIds[$i] ?? null;

            // Buat data meski jurusan/hobi kosong, biar tampil seperti:
            // jurusan,hobi → 1,1 / 2,2 / null,3
            Minat::create([
                'form_kuliah_id' => $formKuliah->id,
                'jurusan_kuliah_id' => $jurusanId,
                'hobi_id' => $hobiId,
                'attempt' => $attempt,
                'is_finished' => false,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data tersimpan sementara.',
        ]);
    }

    public function submit(Request $request)
    {
        $userId = Auth::id();
        $formKuliah = FormKuliah::where('user_id', $userId)->latest()->firstOrFail();

        $attempt = $request->input('attempt');

        Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $attempt)
            ->update(['is_finished' => true]);

        $formKuliah->update(['attempt' => $attempt]);

        return redirect()->route('siswa.kenali-jurusan.index')
            ->with('success', 'Data form kuliah kamu berhasil dikirim!');
    }
}
