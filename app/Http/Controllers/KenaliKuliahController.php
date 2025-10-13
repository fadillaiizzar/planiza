<?php

namespace App\Http\Controllers;

use App\Models\Hobi;
use App\Models\User;
use App\Models\HobiJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KenaliKuliahController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.kenali-jurusan', [
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }
}
