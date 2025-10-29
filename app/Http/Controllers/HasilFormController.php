<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\FormKuliah;

class HasilFormController extends Controller
{
    public function index()
    {
        $items = User::whereHas('formKuliahs.minats') // Ambil user yang punya relasi tabel form kuliah
            ->withCount(['formKuliahs as form_kuliahs_count' => function ($query) {
                $query->has('minats'); // hanya hitung form yang punya minat
            }])
            ->with([
                'siswa.kelas',
                'siswa.jurusan',
                'formKuliahs.minats' => function ($query) {
                    $query->latest('updated_at'); // urutkan dari yang paling baru
                },
            ])
            ->get()
            ->map(function ($user) {
                // Ambil updated_at minat paling akhir (Eloquent tanpa query mentah)
                $latestMinat = $user->formKuliahs
                    ->flatMap->minats
                    ->sortByDesc('updated_at')
                    ->first();

                // Tambahkan properti 'update_terakhir' ke model hasil map
                $user->update_terakhir = $latestMinat?->updated_at;

                return $user;
            })
            ->sortBy('update_terakhir')
            ->values();

        $filterOptions = Kelas::select('nama_kelas as label', 'nama_kelas as value')->get()->toArray();

        $totalUser = $items->count();
        $totalPengerjaan = $items->sum('form_kuliahs_count');

        return view('admin.kenali_jurusan.hasil_form.hasil-form', [
            'items' => $items,
            'filterOptions' => $filterOptions,
            'totalUser' => $totalUser,
            'totalPengerjaan' => $totalPengerjaan,
        ]);
    }

    public function showUserHistory($user_id)
    {
        // Ambil user target (student)
        $student = User::with([
            'siswa.kelas',
            'siswa.jurusan',
            'formKuliahs.minats' => function ($query) {
                $query->latest('updated_at');
            },
        ])->findOrFail($user_id);

        // Ambil semua form_kuliah yang punya minat (berarti sudah submit)
        // Urutkan misalnya berdasarkan created_at atau attempt
        $forms = $student->formKuliahs()
            ->whereHas('minats')
            ->with(['minats' => function ($q) {
                $q->latest('updated_at');
            }])
            ->orderBy('created_at', 'asc') // konsisten urutan attempt
            ->get();

        // Mapping attempts: nomor attempt, update terakhir, form_id
        $attempts = $forms->map(function ($form, $index) {
            $latestMinat = $form->minats->sortByDesc('updated_at')->first();

            return (object) [
                'attempt_number' => $index + 1,   // attempt ke-n
                'update_terakhir' => $latestMinat?->updated_at,
                'form_id' => $form->id,
                'form_model' => $form, // opsional, kalau butuh nanti
            ];
        });

        return view('admin.kenali_jurusan.hasil_form.user-detail', [
            // kirim student bukan 'user' supaya tidak tertimpa oleh include header
            'student' => $student,
            'attempts' => $attempts,
        ]);
    }

    public function showAttempt($user_id, $form_id)
    {
        // Pastikan student ada
        $student = User::findOrFail($user_id);

        // Ambil form spesifik dan verifikasi form milik user
        $form = FormKuliah::with(['minats.jurusanKuliah.kampus', 'minats.hobi'])
            ->where('id', $form_id)
            ->where('user_id', $user_id)
            ->firstOrFail();

        // Kirim form dan student ke view
        return view('admin.kenali_jurusan.hasil_form.user-attempt', [
            // gunakan nama student supaya konsisten dengan perubahan di showUserHistory
            'student' => $student,
            'form' => $form,
        ]);
    }
}
