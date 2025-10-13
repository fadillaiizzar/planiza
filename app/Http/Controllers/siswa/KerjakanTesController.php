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
        $tes = Tes::where('is_active', true)->first();

        if (!$tes) {
            return view('siswa.kenali_profesi.tes.empty-tes');
        }

        $userId = Auth::id();

        $lastAttempt = JawabanSiswa::where('user_id', $userId)
            ->where('tes_id', $tes->id)
            ->where('is_finished', true)
            ->max('attempt');

        if ($lastAttempt) {
            $activeAttempt = $lastAttempt + 1;
        } else {
            $activeAttempt = 1;
        }

        $soals = SoalTes::with(['opsiJawabans', 'jawabanSiswa' => function($q) use($userId, $activeAttempt) {
            $q->where('user_id', $userId)->where('attempt', $activeAttempt);
        }])
            ->where('tes_id', $tes->id)
            ->get();

        return view('siswa.kenali_profesi.tes.tes', compact('tes', 'soals', 'activeAttempt'));
    }

    public function submit(Tes $tes)
    {
        $userId = Auth::id();

        $lastAttempt = JawabanSiswa::where('user_id', $userId)
            ->where('tes_id', $tes->id)
            ->max('attempt');

        JawabanSiswa::where('user_id', $userId)
            ->where('tes_id', $tes->id)
            ->where('attempt', $lastAttempt)
            ->update(['is_finished' => true]);

        return redirect()->route('siswa.kenali-profesi.tes.rekomendasi', [$tes->id, $lastAttempt]);
    }
}
