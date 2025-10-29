<?php

namespace App\Http\Controllers;

use App\Models\Hobi;
use App\Models\User;
use App\Models\FormKuliah;
use App\Models\HobiJurusan;
use Illuminate\Support\Facades\Auth;

class KenaliKuliahController extends Controller
{
    public function index()
    {
        $hobi = Hobi::latest()->get();
        $hobiJurusan = HobiJurusan::latest()->get();
        $hasilForm = FormKuliah::whereHas('minats')
            ->with(['user'])
            ->latest()
            ->get();

        $activities = collect()
            ->merge($hobi)
            ->merge($hobiJurusan)
            ->merge($hasilForm)
            ->sortByDesc('updated_at')
            ->take(10)
            ->map(function ($item) {
                // ✅ Aktivitas Hobi
                if ($item instanceof Hobi) {
                    return [
                        'id' => $item->id,
                        'type' => 'Hobi',
                        'name' => $item->nama_hobi,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                // ✅ Aktivitas Hobi Jurusan
                if ($item instanceof HobiJurusan) {
                    return [
                        'id' => $item->id,
                        'type' => 'Hobi Jurusan',
                        'name' => ($item->hobi->nama_hobi ?? '-') . ' - ' . ($item->jurusanKuliah->nama_jurusan_kuliah ?? '-'),
                        'created_at' => $item->updated_at,
                        'action' => ($item->created_at && $item->updated_at && $item->created_at->eq($item->updated_at)) ? 'create' : 'update',
                    ];
                }

                // ✅ Aktivitas Hasil Form Siswa
                if ($item instanceof FormKuliah) {
                    // 🔢 Ambil semua form milik user ini
                    $userForms = FormKuliah::where('user_id', $item->user_id)
                        ->orderBy('created_at', 'asc')
                        ->pluck('id')
                        ->toArray();

                    // Cari urutan (attempt keberapa)
                    $attemptNumber = array_search($item->id, $userForms) + 1;

                    return [
                        'id' => $item->id,
                        'user_id' => $item->user_id,
                        'type' => 'Hasil Form Siswa',
                        'name' => $item->user->name ?? 'Siswa Tidak Dikenal',
                        'attempt' => $attemptNumber,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'submit' : 'submit',
                    ];
                }

                return null;
            })
            ->filter();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.kenali-jurusan', [
            'activities' => $activities,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }
}
