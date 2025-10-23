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

        $formKuliah = $lastForm;

        if ($lastForm) {
            // Cek apakah form terakhir sudah pernah ada minat
            $hasMinat = Minat::where('form_kuliah_id', $lastForm->id)
                ->exists();

            if (!$hasMinat) {
                // Belum ada minat → pakai form terakhir (jangan buat baru)
                $formKuliah = $lastForm;
            } else {
                // Sudah ada minat → buat form baru
                $formKuliah = FormKuliah::create([
                    'user_id' => $userId,
                    'nilai_utbk' => 0,
                    'attempt' => $lastForm->attempt + 1,
                ]);
            }
        } else {
            // Belum ada form sama sekali → buat form pertama
            $formKuliah = FormKuliah::create([
                'user_id' => $userId,
                'nilai_utbk' => 0,
                'attempt' => 1,
            ]);
        }

        // Attempt aktif diambil dari form kuliah sekarang
        $activeAttempt = $formKuliah->attempt;

        // Ambil minat aktif (jika sudah ada)
        $currentMinat = Minat::where('form_kuliah_id', $formKuliah->id)
            ->where('attempt', $activeAttempt)
            ->get();

        $nilaiUtbk = $formKuliah->nilai_utbk == 0 ? '' : $formKuliah->nilai_utbk;

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
