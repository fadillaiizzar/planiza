<?php

namespace App\Http\Controllers;

use App\Models\Hobi;
use App\Models\User;
use App\Models\HobiJurusan;
use Illuminate\Support\Facades\Auth;

class KenaliKuliahController extends Controller
{
    public function index()
    {
        $hobi = Hobi::latest()->get();
        $hobiJurusan = HobiJurusan::latest()->get();

        $activities = $hobi
            ->merge($hobiJurusan)
            ->sortByDesc('updated_at')
            ->take(10)
            ->map(function ($item) {
                if ($item instanceof Hobi) {
                    return [
                        'id' => $item->id,
                        'type' => 'Hobi',
                        'name' => $item->nama_hobi,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                if ($item instanceof HobiJurusan) {
                    return [
                        'id' => $item->id,
                        'type' => 'Hobi Jurusan',
                        'name' => ($item->hobi->nama_hobi ?? '-') . ' - ' . ($item->jurusanKuliah->nama_jurusan_kuliah ?? '-'),
                        'created_at' => $item->updated_at,
                        'action' => ($item->created_at && $item->updated_at && $item->created_at->eq($item->updated_at)) ? 'create' : 'update',
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
