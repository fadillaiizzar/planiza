<?php

namespace App\Http\Controllers\Siswa\KenaliJurusan;

use App\Models\Minat;
use App\Models\HobiJurusan;
use Illuminate\Http\Request;
use App\Models\JurusanKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KerjakanFormController extends Controller
{
    public function index()
    {
        $jurusanKuliah = JurusanKuliah::all();
        $hobis = HobiJurusan::all();

        return view('siswa.kenali_jurusan.form_kuliah.form-kuliah', compact('jurusanKuliah', 'hobis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nilai_utbk' => 'required|numeric|min:0',
            'jurusan_kuliah_ids' => 'required|array|max:3',
            'hobi_ids' => 'required|array|max:3',
        ]);

        $userId = Auth::id();

        // Cek attempt terakhir
        $lastAttempt = Minat::where('user_id', $userId)->max('attempt');
        $activeAttempt = $lastAttempt ? $lastAttempt + 1 : 1;

        // Simpan data form
        Minat::create([
            'user_id' => $userId,
            'nilai_utbk' => $request->nilai_utbk,
            'jurusan_kuliah_ids' => json_encode($request->jurusan_kuliah_ids),
            'hobi_ids' => json_encode($request->hobi_ids),
            'attempt' => $activeAttempt,
            'is_finished' => true, // karena form ini sekali submit langsung selesai
        ]);

        return redirect()->route('siswa.kenali-jurusan.index')
                         ->with('success', 'Data form kuliah kamu berhasil dikirim!');
    }
}
