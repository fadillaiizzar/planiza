<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KategoriSdgs;
use App\Models\KontribusiSdgs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SdgsController extends Controller
{
    public function index()
    {
        $kategoriSdgs = KategoriSdgs::latest()->get();
        $kontribusiSdgs = KontribusiSdgs::latest()->get();

        $activities = collect()
            ->merge($kategoriSdgs)
            ->merge($kontribusiSdgs)
            ->sortByDesc('updated_at')
            ->take(10)
            ->map(function ($item) {
                // ✅ Aktivitas Kategori Sdgs
                if ($item instanceof KategoriSdgs) {
                    return [
                        'id' => $item->id,
                        'type' => 'Kategori SDGs',
                        'name' => $item->nama_kategori,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                // ✅ Aktivitas Kontribusi Sdgs
                if ($item instanceof KontribusiSdgs) {
                    return [
                        'id' => $item->id,
                        'type' => 'Kontribusi SDGs',
                        'name' => $item->user?->name,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                return null;
            })
            ->filter();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.sdgs', [
            'activities' => $activities,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }
}
