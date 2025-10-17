<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Tes;
use App\Models\SoalTes;
use App\Models\JawabanSiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KerjakanTesController extends Controller
{
    public function index()
    {
        // 🔹 Ambil tes aktif (yang sedang bisa dikerjakan)
        $tes = Tes::where('is_active', true)->first();

        // 🔹 Kalau tidak ada tes aktif, arahkan ke halaman kosong
        if (!$tes) {
            return view('siswa.kenali_profesi.tes.empty-tes');
        }

        $userId = Auth::id();

        // 🔹 Cari attempt terakhir dari user untuk tes ini
        $lastAttempt = JawabanSiswa::where('user_id', $userId)
            ->where('tes_id', $tes->id)
            ->where('is_finished', true)
            ->max('attempt');

        // 🔹 Tentukan attempt aktif (kalau sudah → +1, kalau belum pernah → 1 )
        if ($lastAttempt) {
            $activeAttempt = $lastAttempt + 1;
        } else {
            $activeAttempt = 1;
        }

        // 🔹 Ambil semua soal + opsi jawaban + jawaban siswa di attempt aktif
        $soals = SoalTes::with(['opsiJawabans', 'jawabanSiswa' => function($q) use($userId, $activeAttempt) {
            $q->where('user_id', $userId)->where('attempt', $activeAttempt);
        }])
            ->where('tes_id', $tes->id)
            ->get();

        // 🔹 Kirim ke view tes untuk dikerjakan
        return view('siswa.kenali_profesi.tes.tes', compact('tes', 'soals', 'activeAttempt'));
    }

    public function submit(Tes $tes)
    {
        $userId = Auth::id();

        // 🔹 Ambil attempt terakhir dari user di tes ini
        $lastAttempt = JawabanSiswa::where('user_id', $userId)
            ->where('tes_id', $tes->id)
            ->max('attempt');

        // 🔹 Tandai attempt terakhir sebagai selesai (is_finished = true)
        JawabanSiswa::where('user_id', $userId)
            ->where('tes_id', $tes->id)
            ->where('attempt', $lastAttempt)
            ->update(['is_finished' => true]);

        // 🔹 Redirect ke halaman hasil rekomendasi profesi berdasarkan attempt ini
        return redirect()->route('siswa.kenali-profesi.tes.rekomendasi', [$tes->id, $lastAttempt]);
    }
}
