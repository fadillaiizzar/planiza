<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KenaliJurusan;
use App\Models\KenaliProfesi;

class RekomendasiSdgsController extends Controller
{
    public function index()
    {
        // Ambil daftar user yang punya rekomendasi SDGs
        $items  = KenaliProfesi::with(['user.siswa.kelas'])
            ->where('sumber_rekomendasi', 'sdgs')
            ->select('user_id')
            ->groupBy('user_id')
            ->orderByRaw('MAX(created_at) DESC')
            ->get()
            ->map(function ($item) {
                $user = $item->user;

                $kelas = $user->siswa->kelas->nama_kelas ?? '-';
                $jurusan = $user->siswa->jurusan->nama_jurusan ?? '-';
                $item->kelas = $kelas . ' - ' . $jurusan;

                $item->tanggal = $user->kenaliProfesis()
                    ->where('sumber_rekomendasi','sdgs')
                    ->max('created_at');

                return $item;
            });

        // ============================================================
        // Tambahkan total hasil kontribusi SDGs
        // ============================================================

        // Total rekomendasi profesi SDGs
        $totalProfesi = KenaliProfesi::where('sumber_rekomendasi', 'sdgs')->count();

        // Total rekomendasi jurusan SDGs
        $totalJurusan = KenaliJurusan::where('sumber_rekomendasi', 'sdgs')->count();

        // Total keseluruhan
        $hasilKontribusiCount = $totalProfesi + $totalJurusan;

        return view('admin.sdgs.hasil_kontribusi.index', compact('items', 'totalProfesi', 'totalJurusan', 'hasilKontribusiCount'));
    }

    public function show($userId)
    {
        $profesi = KenaliProfesi::with('profesiKerja')
            ->where('user_id', $userId)
            ->where('sumber_rekomendasi', 'sdgs')
            ->orderBy('total_poin', 'DESC')
            ->get();

        $jurusan = KenaliJurusan::with('jurusanKuliah')
            ->where('user_id', $userId)
            ->where('sumber_rekomendasi', 'sdgs')
            ->orderBy('total_poin', 'DESC')
            ->get();

        $user = $profesi->first()?->user ?? $jurusan->first()?->user;

        return view('admin.sdgs.hasil_kontribusi.show', compact(
            'profesi', 'jurusan', 'user'
        ));
    }
}
