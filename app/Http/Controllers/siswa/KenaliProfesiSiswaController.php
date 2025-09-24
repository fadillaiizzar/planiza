<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KenaliProfesiSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        return view('siswa.pages.kenali-profesi', [
            'siswa' => $siswa
        ]);
    }
}
