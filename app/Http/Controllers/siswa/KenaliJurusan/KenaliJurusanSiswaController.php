<?php

namespace App\Http\Controllers\Siswa\KenaliJurusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KenaliJurusan;
use Illuminate\Support\Facades\Auth;

class KenaliJurusanSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        // $riwayatFormKuliah = KenaliJurusan::with('tes')
        //     ->where('user_id', $user->id)
        //     ->selectRaw('tes_id, MAX(updated_at) as last_updated')
        //     ->groupBy('tes_id')
        //     ->orderByDesc('last_updated')
        //     ->get()
        //     ->map(fn($item) => $item->tes->setRelation('pivot', collect(['updated_at' => $item->last_updated])));

        return view('siswa.pages.kenali-jurusan', [
            'siswa' => $siswa,
            // 'riwayatTes' => $riwayatTes,
        ]);
    }
}
