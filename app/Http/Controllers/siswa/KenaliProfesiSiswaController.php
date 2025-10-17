<?php

namespace App\Http\Controllers\siswa;

use Illuminate\Http\Request;
use App\Models\KenaliProfesi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KenaliProfesiSiswaController extends Controller
{
    public function index()
    {
        // 🔹 Ambil data user yang sedang login dan cek apakah user punya relasi siswa
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        // 🔹 Ambil seluruh riwayat hasil tes kenali profesi user
        $riwayatTes = KenaliProfesi::with('tes')
            ->where('user_id', $user->id)
            ->selectRaw('tes_id, MAX(updated_at) as last_updated')
            ->groupBy('tes_id')
            ->orderByDesc('last_updated')
            ->get()
            ->map(fn($item) => $item->tes->setRelation('pivot', collect(['updated_at' => $item->last_updated])));

        // 🔹 Kirim data siswa + riwayat tes ke view
        return view('siswa.pages.kenali-profesi', [
            'siswa' => $siswa,
            'riwayatTes' => $riwayatTes,
        ]);
    }
}
