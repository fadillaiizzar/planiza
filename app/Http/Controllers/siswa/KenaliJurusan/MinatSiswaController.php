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
        $validated = $request->validate([
            'nilai_utbk' => 'required|numeric|min:0|max:1000',
            'jurusan_kuliah_ids' => 'required|array|min:1|max:3',
            'jurusan_kuliah_ids.*' => 'integer|exists:jurusan_kuliahs,id',
            'hobi_ids' => 'required|array|min:1|max:3',
            'hobi_ids.*' => 'integer|exists:hobi_jurusans,id',
        ], [
            'nilai_utbk.required' => 'Nilai UTBK wajib diisi.',
            'nilai_utbk.numeric' => 'Nilai UTBK harus berupa angka.',
            'jurusan_kuliah_ids.required' => 'Pilih minimal 1 jurusan.',
            'jurusan_kuliah_ids.max' => 'Kamu hanya bisa memilih maksimal 3 jurusan.',
            'hobi_ids.required' => 'Pilih minimal 1 hobi.',
            'hobi_ids.max' => 'Kamu hanya bisa memilih maksimal 3 hobi.',
        ]);

        $userId = Auth::id();

        // Ambil atau buat data form_kuliah untuk user
        $formKuliah = FormKuliah::firstOrCreate(
            ['user_id' => $userId],
            ['nilai_utbk' => $request->nilai_utbk]
        );

        // 🔍 Cek apakah masih ada minat yang belum selesai
        $unfinished = Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('is_finished', false)
            ->latest('attempt')
            ->first();

        if ($unfinished) {
            // ✏️ Update yang belum selesai
            $unfinished->update([
                'jurusan_kuliah_ids' => json_encode($request->jurusan_kuliah_ids),
                'hobi_ids' => json_encode($request->hobi_ids),
                'is_finished' => true, // kalau ini kirim (submit)
            ]);
        } else {
            // 🆕 Buat attempt baru karena yang lama sudah selesai semua
            $lastAttempt = Minat::where('form_kuliah_id', $formKuliah->id)->max('attempt');
            $activeAttempt = $lastAttempt ? $lastAttempt + 1 : 1;

            Minat::create([
                'form_kuliah_id' => $formKuliah->id,
                'jurusan_kuliah_ids' => json_encode($request->jurusan_kuliah_ids),
                'hobi_ids' => json_encode($request->hobi_ids),
                'attempt' => $activeAttempt,
                'is_finished' => true,
            ]);
        }

        return redirect()->route('siswa.kenali-jurusan.index')->with('success', 'Data form kuliah kamu berhasil dikirim!');
    }
}
