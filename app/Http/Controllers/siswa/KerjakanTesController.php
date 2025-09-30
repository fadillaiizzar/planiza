<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Tes;
use App\Models\SoalTes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KerjakanTesController extends Controller
{
    public function index()
    {
        $tes = Tes::where('is_active', true)->first();

        if (!$tes) {
            return view('siswa.tes.empty');
        }

        $soals = SoalTes::with([
            'opsiJawabans',
            'jawabanSiswa' => function($q) {
                $q->where('user_id', Auth::id());
            }
        ])->where('tes_id', $tes->id)->get();

        return view('siswa.kenali_profesi.tes.index', compact('tes', 'soals'));
    }

    public function submit(Tes $tes)
    {
        $siswa = Auth::user()->siswa;

        $siswa->update([
            'tes_selesai' => true,
        ]);

        return redirect()->route('siswa.kenali-profesi.tes.rekomendasi', $tes->id);
    }
}
