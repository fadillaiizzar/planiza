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

        $soals = SoalTes::where('tes_id', $tes->id)->with('opsiJawabans')->get();

        return view('siswa.kenali_profesi.tes.index', compact('tes', 'soals'));
    }

    public function submit(Tes $tes)
    {
        $siswa = Auth::user()->siswa;

        $siswa->update([
            'tes_selesai' => true,
        ]);

        return redirect()->route('siswa.tes.rekomendasi', $tes->id);
    }
}
