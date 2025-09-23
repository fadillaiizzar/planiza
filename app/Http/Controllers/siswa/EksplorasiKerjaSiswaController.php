<?php

namespace App\Http\Controllers\Siswa;

use App\Models\ProfesiKerja;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class EksplorasiKerjaSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;
        $jurusanSiswa = $siswa?->jurusan->nama_jurusan ?? null;

        $jurusans = ProfesiKerja::select('info_jurusan')
            ->distinct()
            ->orderBy('info_jurusan')
            ->paginate(3);

        $profesiKerjas = ProfesiKerja::orderBy('info_jurusan', $jurusans->pluck('info_jurusan'))
            ->orderBy('nama_profesi_kerja')
            ->get()
            ->groupBy('info_jurusan');

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

        if ($jurusanSiswa) {
            $jurusanCollection = collect([
                $jurusanSiswa => $profesiKerjas->get($jurusanSiswa, collect())
            ]);

            $profesiKerjas = $jurusanCollection->merge(
                Arr::except($profesiKerjas, $jurusanSiswa)
            );
        }

        return view('siswa.pages.eksplorasi-kerja', compact('siswa', 'jurusans', 'profesiKerjas', 'jurusanNames'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        $profesi = ProfesiKerja::with('industris')->findOrFail($id);

        return view('siswa.eksplorasi_kerja.show', compact('profesi', 'siswa'));
    }
}
