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

        // Pastikan formKuliah milik user
        if ($formKuliah->user_id !== $userId) {
            abort(403, 'Akses tidak sah.');
        }

        $attempt = (int) $request->input('attempt');
        $jurusanIds = (array) $request->input('jurusan_kuliah_ids', []);
        $hobiIds = (array) $request->input('hobi_ids', []);
        $nilaiUtbk = (int) $request->input('nilai_utbk', 0);

        // Pastikan attempt juga disimpan di form_kuliahs
        $formKuliah->update([
            'nilai_utbk' => $nilaiUtbk,
            'attempt' => $attempt,
        ]);

        // Hapus data minat lama pada attempt ini agar tidak ganda
        Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $attempt)
            ->delete();

        // Simpan minat baru
        $maxSlots = 3;
        $countInput = max(count($jurusanIds), count($hobiIds));

        for ($i = 0; $i < $countInput && $i < $maxSlots; $i++) {
            Minat::create([
                'form_kuliah_id' => $formKuliah->id,
                'jurusan_kuliah_id' => $jurusanIds[$i] ?? null,
                'hobi_id' => $hobiIds[$i] ?? null,
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

        $attempt = (int) $request->input('attempt');
        $jurusanIds = (array) $request->input('jurusan_kuliah_ids', []);
        $hobiIds = (array) $request->input('hobi_ids', []);
        $nilaiUtbk = (int) $request->input('nilai_utbk', 0);

        // 🧩 Pastikan data jurusan, hobi, dan nilai UTBK juga tersimpan saat submit
        $formKuliah->update([
            'nilai_utbk' => $nilaiUtbk,
            'attempt' => $attempt,
        ]);

        // Hapus data minat lama di attempt ini
        Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $attempt)
            ->delete();

        // Simpan ulang data baru dan tandai langsung selesai
        $maxSlots = 3;
        $countInput = max(count($jurusanIds), count($hobiIds));

        for ($i = 0; $i < $countInput && $i < $maxSlots; $i++) {
            Minat::create([
                'form_kuliah_id' => $formKuliah->id,
                'jurusan_kuliah_id' => $jurusanIds[$i] ?? null,
                'hobi_id' => $hobiIds[$i] ?? null,
                'attempt' => $attempt,
                'is_finished' => true,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data form kuliah kamu berhasil dikirim!',
            'redirect_url' => route('siswa.kenali-jurusan.form-kuliah.rekomendasi', [
                'formKuliah' => $formKuliah->id,
                'attempt' => $formKuliah->attempt,
            ]),
        ]);
    }
}
