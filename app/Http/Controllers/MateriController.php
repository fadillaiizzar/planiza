<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MateriController extends Controller
{
    public function index()
    {
        return view('admin.pages.materi', [
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
        ]);
    }
}
