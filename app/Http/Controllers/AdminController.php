<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Rencana;
use App\Models\Siswa;

class AdminController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $kelas = Kelas::all();
        $jurusans = Jurusan::all();
        $rencanas = Rencana::all();

        return view('admin.pages.dashboard', [
            'user' => Auth::user(),
            'userCount' => User::count(),
            'materiCount' => 23,
            'eksplorasiCount' => 12,
            'aktivitas' => [
                (object)[
                    'created_at' => now()->subMinutes(5),
                    'user' => (object)['name' => 'Dilla'],
                    'aktivitas' => 'Menambahkan materi baru',
                ],
                (object)[
                    'created_at' => now()->subHours(1),
                    'user' => (object)['name' => 'Rina'],
                    'aktivitas' => 'Mengedit eksplorasi',
                ],
                (object)[
                    'created_at' => now()->subDays(1),
                    'user' => (object)['name' => 'Budi'],
                    'aktivitas' => 'Menghapus akun user',
                ],
            ],
            'roles' => $roles,
            'kelas' => $kelas,
            'jurusans' => $jurusans,
            'rencanas' => $rencanas,
        ]);
    }
}
