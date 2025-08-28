<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProfesiKerja;
use Illuminate\Http\Request;
use App\Models\KategoriMinat;
use Illuminate\Support\Facades\Auth;

class KenaliKerjaController extends Controller
{
    public function index()
    {
        $kategoriMinat = KategoriMinat::latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'Kategori Minat',
                'name' => $item->nama_kategori,
                'created_at' => $item->updated_at,
                'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
            ];
        });

        $profesiKerja = ProfesiKerja::latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'Profesi Kerja',
                'name' => $item->nama_profesi_kerja,
                'created_at' => $item->updated_at,
                'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
            ];
        });

        $activities = $kategoriMinat
            ->merge($profesiKerja)
            ->sortByDesc('created_at')
            ->take(10);

        $profesiCount = ProfesiKerja::count();
        $kategoriMinatCount = KategoriMinat::count();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.kenali-profesi', [
            'activities' => $activities,
            'profesiCount' => $profesiCount,
            'kategoriMinatCount' => $kategoriMinatCount,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }
}
