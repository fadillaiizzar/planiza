<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Rencana;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

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

        $roles = Role::all();
        $kelas = Kelas::all();
        $jurusans = Jurusan::all();
        $rencanas = Rencana::all();

        return view('admin.pages.user', [
            'user' => Auth::user(),
            'userCount' => $userCount,
            'adminCount' => $adminCount,
            'siswaCount' => $siswaCount,
            'aktivitas' => User::latest()->get(),
            'users' => $users,
            'roles' => $roles,
            'kelas' => $kelas,
            'jurusans' => $jurusans,
            'rencanas' => $rencanas,
        ]);
    }
}
