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

        $lastForm = FormKuliah::where('user_id', $userId)
            ->latest('id')
            ->first();

        // Cek apakah form terakhir punya minat yang belum selesai
        $hasUnfinished = false;
        if ($lastForm) {
            $hasUnfinished = Minat::where('form_kuliah_id', $lastForm->id)
                ->where('is_finished', false)
                ->exists();
        }

        // Jika belum ada form kuliah atau form terakhir sudah selesai semua → buat form baru
        if (!$lastForm || !$hasUnfinished) {
            $nextAttempt = $lastForm ? $lastForm->attempt + 1 : 1;

            $formKuliah = FormKuliah::create([
                'user_id' => $userId,
                'nilai_utbk' => 0,
                'attempt' => $nextAttempt, // <── ditambah kolom attempt di form_kuliahs
            ]);
        } else {
            $formKuliah = $lastForm;
        }

        // Attempt aktif diambil dari form kuliah sekarang
        $activeAttempt = $formKuliah->attempt;

        // Ambil minat aktif (jika sudah ada)
        $currentMinat = Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $activeAttempt)
            ->get();

        $nilaiUtbk = $formKuliah->nilai_utbk;

        $jurusanSelected = $currentMinat->pluck('jurusan_kuliah_id')
            ->filter()
            ->toArray();

        $hobiSelected = $currentMinat->pluck('hobi_id')
            ->filter()
            ->toArray();

        // Data dropdown
        $jurusanKuliah = JurusanKuliah::all();
        $hobis = Hobi::all();

        return view('siswa.kenali_jurusan.form_kuliah.form-kuliah', compact('jurusanKuliah', 'hobis', 'activeAttempt', 'formKuliah', 'jurusanSelected', 'hobiSelected', 'nilaiUtbk'));
    }
}
