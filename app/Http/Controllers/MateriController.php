<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materi;
use App\Models\TopikMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index()
    {
        // Ambil data materi dengan relasi topikMateri dan paginasi
        $materis = Materi::with(['topikMateri'])->oldest()->paginate(10);

        $materisCount = Materi::count();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.materi', [
            'materis' => $materis,
            'materisCount' => $materisCount,
            'user' => $user,
            'userCount' => $userCount,
            'aktivitas' => Materi::latest()->get(),
        ]);
    }
}
