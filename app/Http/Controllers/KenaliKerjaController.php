<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProfesiKerja;
use Illuminate\Http\Request;
use App\Models\KategoriMinat;
use App\Models\ProfesiKategori;
use Illuminate\Support\Facades\Auth;

class KenaliKerjaController extends Controller
{
    public function index()
    {
        $kategoriMinat = KategoriMinat::latest()->get();
        $profesiKerja = ProfesiKerja::latest()->get();
        $profesiKategori = ProfesiKategori::latest()->get();

        $activities = $kategoriMinat
            ->merge($profesiKerja)
            ->merge($profesiKategori)
            ->sortByDesc('updated_at')
            ->take(10)
            ->map(function ($item) {
                if ($item instanceof KategoriMinat) {
                    return [
                        'id' => $item->id,
                        'type' => 'Kategori Minat',
                        'name' => $item->nama_kategori,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                if ($item instanceof ProfesiKerja) {
                    return [
                        'id' => $item->id,
                        'type' => 'Profesi Kerja',
                        'name' => $item->nama_profesi_kerja,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                if ($item instanceof ProfesiKategori) {
                    return [
                        'id' => $item->id,
                        'type' => 'Profesi Kategori',
                        'name' => ($item->profesiKerja->nama_profesi_kerja ?? '-') . ' - ' . ($item->kategoriMinat->nama_kategori ?? '-'),
                        'created_at' => $item->updated_at,
                        'action' => ($item->created_at && $item->updated_at && $item->created_at->eq($item->updated_at)) ? 'create' : 'update',
                    ];
                }

                return null;
            })
            ->filter();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.kenali-profesi', [
            'activities' => $activities,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }
}
