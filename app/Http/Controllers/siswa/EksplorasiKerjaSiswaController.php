<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Materi;
use App\Models\TopikMateri;
use App\Models\ProfesiKerja;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EksplorasiKerjaSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        $profesiKerjas = ProfesiKerja::oldest()->get();

        return view('siswa.pages.eksplorasi-kerja', compact('profesiKerjas', 'siswa'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        $profesi = ProfesiKerja::with('industris')->findOrFail($id);

        return view('siswa.eksplorasi_kerja.show', compact('profesi', 'siswa'));
    }
}
