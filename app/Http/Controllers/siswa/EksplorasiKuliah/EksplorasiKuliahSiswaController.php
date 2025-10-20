<?php

namespace App\Http\Controllers\Siswa\EksplorasiKuliah;

use App\Models\JurusanKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class EksplorasiKuliahSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;
        $jurusanSiswa = $siswa?->jurusan->nama_jurusan ?? null;

        $jurusans = JurusanKuliah::select('info_jurusan')
            ->groupBy('info_jurusan')
            ->orderBy('info_jurusan')
            ->get()
            ->pluck('info_jurusan');

        $jurusanKuliahs = JurusanKuliah::orderBy('nama_jurusan_kuliah')->get()->groupBy('info_jurusan');

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

        return view('siswa.pages.eksplorasi-kuliah', [
            'siswa' => $siswa,
            'jurusans' => $paginatedJurusans,
            'jurusanKuliahs' => $jurusanKuliahs,
            'jurusanNames' => $jurusanNames,
        ]);
    }

    public function show($id)
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        $jurusanKuliah = JurusanKuliah::with('kampusJurusans.kampus')->findOrFail($id);

        return view('siswa.eksplorasi_kuliah.show', compact('jurusanKuliah', 'siswa'));
    }
}
