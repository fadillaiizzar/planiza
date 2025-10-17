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

         // Ambil slot yang ada untuk attempt ini
        $slots = Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $attempt)
            ->orderBy('id')
            ->get()
            ->toArray();

        $maxSlots = 3; // maksimal slot

        // Gabungkan input
        $newSlots = [];
        $countInput = max(count($jurusanIds), count($hobiIds));

        for ($i = 0; $i < $countInput; $i++) {
            $jurusanId = $jurusanIds[$i] ?? null;
            $hobiId = $hobiIds[$i] ?? null;

            // lewati jika kosong semua
            if ($jurusanId === null && $hobiId === null) continue;

            $newSlots[] = [
                'jurusan_kuliah_id' => $jurusanId,
                'hobi_id' => $hobiId,
            ];
        }

        // Perbarui slot yang ada atau buat baru
        for ($i = 0; $i < $maxSlots; $i++) {
            $newSlot = $newSlots[$i] ?? null;

            if (isset($slots[$i])) {
                // slot ada → update jika ada data baru, hapus jika kosong semua
                if ($newSlot) {
                    Minat::where('id', $slots[$i]['id'])
                        ->update([
                            'jurusan_kuliah_id' => $newSlot['jurusan_kuliah_id'],
                            'hobi_id' => $newSlot['hobi_id'],
                        ]);
                } else {
                    Minat::where('id', $slots[$i]['id'])->delete();
                }
            } else {
                // slot belum ada → buat baru kalau ada data
                if ($newSlot) {
                    Minat::create([
                        'form_kuliah_id' => $formKuliah->id,
                        'jurusan_kuliah_id' => $newSlot['jurusan_kuliah_id'],
                        'hobi_id' => $newSlot['hobi_id'],
                        'attempt' => $attempt,
                        'is_finished' => false,
                    ]);
                }
            }
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

        return response()->json([
            'success' => true,
            'message' => 'Data form kuliah kamu berhasil dikirim!',
            'redirect_url' => route('siswa.kenali-jurusan.form-kuliah.rekomendasi', $formKuliah->id)
        ]);
    }
}
