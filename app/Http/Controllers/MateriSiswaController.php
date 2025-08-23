<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\TopikMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;
        if ($siswa) {
            $topikMateris = TopikMateri::with(['materis', 'kelas', 'jurusan', 'rencana'])
                ->where('kelas_id', $siswa->kelas_id)
                ->where('jurusan_id', $siswa->jurusan_id)
                ->where('rencana_id', $siswa->rencana_id)
                ->oldest()
                ->get();
        } else {
            $topikMateris = collect();
        }

        return view('siswa.pages.materi', compact('topikMateris', 'siswa'));
    }

    public function show($id)
    {
        $materi = Materi::with('topikMateri')->findOrFail($id);

        $files = json_decode($materi->file_materi, true) ?? [];
        $filePath = count($files) > 0 ? asset('storage/' . $files[0]) : null;

        $siswa = $user->siswa ?? null;

        return view('siswa.materi.show', compact('materi', 'filePath', 'siswa'));
    }

}
