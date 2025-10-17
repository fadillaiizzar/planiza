<?php

namespace App\Http\Controllers\Siswa\KenaliJurusan;

use App\Models\Minat;
use App\Models\FormKuliah;
use Illuminate\Http\Request;
use App\Models\KenaliJurusan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KenaliJurusanSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        // 🔹 Ambil attempt dari form kuliah yang sudah disubmit (is_finished = true)
        $finishedAttempts = Minat::where('is_finished', true)
            ->whereHas('formKuliah', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->select('attempt', DB::raw('MAX(updated_at) as last_updated'))
            ->groupBy('attempt')
            ->orderByDesc('last_updated')
            ->get();

        // 🔹 Ambil form kuliah yang sesuai dengan attempt tersebut
        $riwayatForm = $finishedAttempts->map(function ($item) use ($user) {
            $form = FormKuliah::where('user_id', $user->id)
                ->where('attempt', $item->attempt)
                ->first();

            return (object) [
                'attempt' => $item->attempt,
                'form' => $form,
                'last_updated' => $item->last_updated,
            ];
        })->filter(fn($item) => $item->form !== null); // hanya form valid

        return view('siswa.pages.kenali-jurusan', [
            'siswa' => $siswa,
            'riwayatForm' => $riwayatForm,
        ]);
    }
}
