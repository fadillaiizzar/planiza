<?php

namespace App\Http\Controllers\Siswa\KontribusiSdgs;

use App\Models\KategoriSdgs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KontribusiSdgsSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        $kategoriSdgs = KategoriSdgs::orderBy('nomor_kategori')->get();

       return view('siswa.pages.kontribusi-sdgs', compact('siswa', 'kategoriSdgs'));
    }
}
