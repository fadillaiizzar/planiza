<?php

namespace App\Http\Controllers\Siswa\KenaliJurusan;

use App\Models\Hobi;
use App\Models\Minat;
use App\Models\FormKuliah;
use App\Models\JurusanKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KerjakanFormController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $formKuliah = FormKuliah::firstOrCreate(
            ['user_id' => $userId],
            ['nilai_utbk' => 0]
        );

        // Cek apakah masih ada attempt yang belum selesai
        $unfinished = Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('is_finished', false)
            ->latest('attempt')
            ->first();

        if ($unfinished) {
            $activeAttempt = $unfinished->attempt;
        } else {
            $lastAttempt = Minat::where('form_kuliah_id', $formKuliah->id)->max('attempt');
            $activeAttempt = $lastAttempt ? $lastAttempt + 1 : 1;
        }

        $currentMinat = Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $activeAttempt)
            ->first();

        $jurusanKuliah = JurusanKuliah::all();
        $hobis = Hobi::all();

        return view('siswa.kenali_jurusan.form_kuliah.form-kuliah', compact('jurusanKuliah', 'hobis', 'activeAttempt', 'formKuliah', 'currentMinat'));
    }
}
