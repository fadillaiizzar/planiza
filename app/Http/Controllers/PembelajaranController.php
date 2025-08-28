<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materi;
use App\Models\TopikMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelajaranController extends Controller
{
    public function index()
    {
        $topikMateri = TopikMateri::latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'Topik Materi',
                'name' => $item->judul_topik,
                'created_at' => $item->updated_at,
                'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
            ];
        });

        $materi = Materi::latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'Materi',
                'name' => $item->nama_materi,
                'created_at' => $item->updated_at,
                'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
            ];
        });

        $activities = $topikMateri
            ->merge($materi)
            ->sortByDesc('created_at')
            ->take(10);

        $topikMateriCount = TopikMateri::count();
        $materiCount = Materi::count();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.pembelajaran', [
            'activities' => $activities,
            'topikMateriCount' => $topikMateriCount,
            'materiCount' => $materiCount,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }
}
