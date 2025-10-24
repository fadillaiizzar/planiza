<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        $totalUser = $items->count();
        $totalPengerjaan = $items->sum('form_kuliahs_count');

        return view('admin.kenali_jurusan.hasil_form.hasil-form', [
            'items' => $items,
            'totalUser' => $totalUser,
            'totalPengerjaan' => $totalPengerjaan,
        ]);
    }

    public function showUserHistory($user_id)
    {
        // Ambil user hanya user yang punya data form
        $user = User::with(['siswa.kelas', 'siswa.jurusan', 'formKuliahs'])
            ->where('id', $user_id)
            ->firstOrFail();

        // Ambil riwayat pengerjaan user
        $history = FormKuliah::where('user_id', $user_id)
            ->orderBy('updated_at', 'asc')
            ->get();

        // Mapping riwayat ke format yang dibutuhkan
        $riwayat = $history->map(function($item, $index) {
            return [
                'ke' => $index + 1,
                'tanggal' => \Carbon\Carbon::parse($item->updated_at)->format('d M Y H:i'),
                'id_form' => $item->id,
            ];
        });

        // Kirim data langsung ke view
        return view('admin.kenali_jurusan.hasil_form.user-detail', [
            'user' => $user,
            'data' => [
                'nama' => $user->name, // pastikan kolom di DB 'name' atau 'nama'
                'riwayat' => $riwayat,
                'total' => $riwayat->count(),
            ],
            'attempts' => $history,
        ]);
    }

    public function showAttempt ($user_id, $attempt)
    {
        $user = User::findOrFail($user_id);

        // Ambil semua attempt dari FormKuliah milik user
        $attempts = FormKuliah::with(['minats.jurusanKuliah', 'minats.hobi'])
            ->where('user_id', $user_id)
            ->orderBy('attempt', 'asc')
            ->get();

        return view('admin.kenali_jurusan.hasil_form.user-attempt', [
            'user' => $user,
            'attempts' => $attempts,
            'selectedAttempt' => $attempt,
        ]);
    }
}
