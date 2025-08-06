<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
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
