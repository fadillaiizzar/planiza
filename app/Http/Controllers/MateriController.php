<?php

namespace App\Http\Controllers;

use App\Models\TopikMateri;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $topikMateri = TopikMateri::with('materis')->get();
        return view('siswa.pages.materi', compact('topikMateri'));
    }
}
