<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tes;
use Illuminate\Support\Facades\Auth;

class RekomendasiProfesiController extends Controller
{
    public function index($tesId)
    {
        $tes = Tes::findOrFail($tesId);
        $siswa = Auth::user()->siswa;

        $jawaban = $siswa->jawabanSiswa()->whereHas('soal', function ($q) use ($tesId) {
            $q->where('tes_id', $tesId);
        })->get();

        $rekomendasi = 'Profesi sesuai minat bakat kamu adalah ...';

        return view('siswa.tes.rekomendasi', compact('tes', 'jawaban', 'rekomendasi'));
    }
}
