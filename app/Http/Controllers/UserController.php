<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->oldest()->paginate(10);
        $userCount = User::count();

        $adminCount = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->count();

        $siswaCount = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'siswa');
        })->count();

        return view('admin.pages.user', [
            'user' => Auth::user(),
            'userCount' => $userCount,
            'adminCount' => $adminCount,
            'siswaCount' => $siswaCount,
            'aktivitas' => User::latest()->get(),
            'users' => $users
        ]);
    }
}
