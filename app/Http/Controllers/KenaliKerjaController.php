<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProfesiKerja;
use Illuminate\Http\Request;
use App\Models\KategoriMinat;
use App\Models\OpsiJawaban;
use App\Models\ProfesiKategori;
use App\Models\SoalTes;
use App\Models\Tes;
use Illuminate\Support\Facades\Auth;

class KenaliKerjaController extends Controller
{
    public function index()
    {
        $kategoriMinat = KategoriMinat::latest()->get();
        $profesiKategori = ProfesiKategori::latest()->get();
        $tes = Tes::latest()->get();
        $soalTes = SoalTes::latest()->get();
        $opsiJawaban = OpsiJawaban::latest()->get();

        $activities = $kategoriMinat
            ->merge($profesiKategori)
            ->merge($tes)
            ->merge($soalTes)
            ->merge($opsiJawaban)
            ->sortByDesc('updated_at')
            ->take(10)
            ->map(function ($item) {
                if ($item instanceof KategoriMinat) {
                    return [
                        'id' => $item->id,
                        'type' => 'Kategori Minat',
                        'name' => $item->nama_kategori,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                if ($item instanceof ProfesiKategori) {
                    return [
                        'id' => $item->id,
                        'type' => 'Profesi Kategori',
                        'name' => ($item->profesiKerja->nama_profesi_kerja ?? '-') . ' - ' . ($item->kategoriMinat->nama_kategori ?? '-'),
                        'created_at' => $item->updated_at,
                        'action' => ($item->created_at && $item->updated_at && $item->created_at->eq($item->updated_at)) ? 'create' : 'update',
                    ];
                }

                if ($item instanceof Tes) {
                    return [
                        'id' => $item->id,
                        'type' => 'Tes',
                        'name' => $item->nama_tes,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                if ($item instanceof SoalTes) {
                    return [
                        'id' => $item->id,
                        'type' => 'Soal Tes',
                        'name' => $item->isi_pertanyaan,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                if ($item instanceof OpsiJawaban) {
                    return [
                        'id' => $item->id,
                        'type' => 'Opsi Jawaban',
                        'name' => $item->isi_opsi,
                        'created_at' => $item->updated_at,
                        'action' => $item->created_at->eq($item->updated_at) ? 'create' : 'update',
                    ];
                }

                return null;
            })
            ->filter();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.kenali-profesi', [
            'activities' => $activities,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }
}
