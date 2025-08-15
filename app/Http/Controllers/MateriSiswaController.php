<?php

namespace App\Http\Controllers;

use App\Models\TopikMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;
        $topikMateris = TopikMateri::with('materis')->oldest()->get();
        return view('siswa.pages.materi', compact('topikMateris', 'siswa'));
    }
}
