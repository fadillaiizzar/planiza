<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Industri;
use App\Models\ProfesiKerja;
use App\Models\IndustriProfesi;
use Illuminate\Support\Facades\Auth;

class EksplorasiKerjaController extends Controller
{
    public function index()
    {
        $profesi = ProfesiKerja::latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'profesi',
                'name' => $item->nama_profesi_kerja,
                'created_at' => $item->updated_at,
                'action' => optional($item->created_at)->eq($item->updated_at) ? 'create' : 'update',
            ];
        });

        $industri = Industri::latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'industri',
                'name' => $item->nama_industri,
                'created_at' => $item->updated_at,
                'action' => optional($item->created_at)->eq($item->updated_at) ? 'create' : 'update',
            ];
        });

        $industriProfesi = IndustriProfesi::latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'industri-profesi',
                'name' => ($item->industri->nama_industri ?? '-') . ' - ' . ($item->profesiKerja->nama_profesi_kerja ?? '-'),
                'created_at' => $item->updated_at,
                'action' => optional($item->created_at)->eq($item->updated_at) ? 'create' : 'update',
            ];
        });

        $activities = $profesi
            ->merge($industri)
            ->merge($industriProfesi)
            ->sortByDesc('created_at')
            ->take(10);

        $profesiCount = ProfesiKerja::count();
        $industriCount = Industri::count();
        $industriProfesiCount = IndustriProfesi::count();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.eksplorasi-profesi', [
            'activities' => $activities,
            'profesiCount' => $profesiCount,
            'industriCount' => $industriCount,
            'industriProfesiCount' => $industriProfesiCount,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }
}
