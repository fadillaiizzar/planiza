<?php

namespace App\Http\Controllers\Siswa;

use App\Models\ProfesiKerja;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class EksplorasiKerjaSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;
        $jurusanSiswa = $siswa?->jurusan->nama_jurusan ?? null;

        $jurusans = ProfesiKerja::select('info_jurusan')
            ->groupBy('info_jurusan')
            ->orderBy('info_jurusan')
            ->get()
            ->pluck('info_jurusan');

        $profesiKerjas = ProfesiKerja::orderBy('nama_profesi_kerja')->get()->groupBy('info_jurusan');

        if ($jurusanSiswa) {
            $jurusans = $jurusans->reject(fn($j) => $j === $jurusanSiswa);
            $jurusans = $jurusans->prepend($jurusanSiswa);
        }

        $perPage = 3;
        $currentPage = request()->get('page', 1);
        $items = $jurusans->forPage($currentPage, $perPage);
        $paginatedJurusans = new LengthAwarePaginator(
            $items,
            $jurusans->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $jurusanNames = [
            'DKV'  => 'Desain Komunikasi Visual',
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'SIJA' => 'Sistem Informasi Jaringan dan Aplikasi',
            'TKR'  => 'Teknik Kendaraan Ringan',
            'TITL' => 'Teknik Instalasi Tenaga Listrik',
            'TAV'  => 'Teknik Audio Video',
            'TP'   => 'Teknik Pemesinan',
            'KGSP' => 'Konstruksi Gedung Sanitasi dan Perawatan',
            'GEO'  => 'Geomatika',
        ];

        return view('siswa.pages.eksplorasi-kerja', [
            'siswa' => $siswa,
            'jurusans' => $paginatedJurusans,
            'profesiKerjas' => $profesiKerjas,
            'jurusanNames' => $jurusanNames,
        ]);
    }

    public function show($id)
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        $profesi = ProfesiKerja::with('industris')->findOrFail($id);

        return view('siswa.eksplorasi_kerja.show', compact('profesi', 'siswa'));
    }
}
