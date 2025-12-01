<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HubunganSdgs;
use App\Models\KategoriSdgs;
use App\Models\KenaliJurusan;
use App\Models\KenaliProfesi;
use App\Models\KontribusiSdgs;
use Illuminate\Support\Facades\Auth;

class SdgsController extends Controller
{
    public function index()
    {
        $kategoriSdgs = KategoriSdgs::latest()->get();
        $kontribusiSdgs = KontribusiSdgs::latest()->get();
        $hubunganSdgs = HubunganSdgs::latest()->get();
        $rekomendasiProfesi = KenaliProfesi::where('sumber_rekomendasi', 'sdgs')->latest()->get();
        $rekomendasiJurusan = KenaliJurusan::where('sumber_rekomendasi', 'sdgs')->latest()->get();

        $activities = collect()
            ->merge($kategoriSdgs)
            ->merge($kontribusiSdgs)
            ->merge($hubunganSdgs)
            ->merge($rekomendasiProfesi)
            ->merge($rekomendasiJurusan)
            ->sortByDesc('updated_at')
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
                        'action' => $item->created_at->eq($item->updated_at) ? 'submit' : 'update',
                    ];
                }

                // ✅ Aktivitas Hubungan Sdgs
                if ($item instanceof HubunganSdgs) {
                    $parts = array_filter([
                        $item->kategoriSdgs?->nama_kategori,
                        $item->profesiKerja?->nama_profesi_kerja,
                        $item->jurusanKuliah?->nama_jurusan_kuliah
                    ]);

                    return [
                        'id' => $item->id,
                        'type' => 'Hubungan SDGs',
                        'name' => implode(' - ', $parts) ?: '-',
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                // ✅ Aktivitas Rekomendasi Profesi
                if ($item instanceof KenaliProfesi) {
                    return [
                        'id' => $item->user_id,
                        'type' => 'Hasil Kontribusi SDGs',
                        'name' => $item->user?->name,
                        'created_at' => $item->created_at,
                        'action' => 'submit',
                    ];
                }

                // ✅ Aktivitas Rekomendasi Profesi
                if ($item instanceof KenaliJurusan) {
                    return [
                        'id' => $item->user_id,
                        'type' => 'Hasil Kontribusi SDGs',
                        'name' => $item->user?->name,
                        'created_at' => $item->created_at,
                        'action' => 'submit',
                    ];
                }

                return null;
            })
            ->filter()
            ->unique(function ($item) {
                // Hanya 1 aktivitas Rekomendasi SDGs per user
                return ($item['type'] === 'Hasil Kontribusi SDGs')
                    ? 'rek-'.$item['id']
                    : $item['id'];
            })
            ->take(10);

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.sdgs', [
            'activities' => $activities,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }
}
