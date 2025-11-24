<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kampus;
use Illuminate\Http\Request;
use App\Models\JurusanKuliah;
use App\Models\KampusJurusan;
use Illuminate\Support\Facades\Auth;

class EksplorasiKuliahController extends Controller
{
    public function index() {
        $jurusanKuliah = JurusanKuliah::latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'kuliah',
                'name' => $item->nama_jurusan_kuliah,
                'created_at' => $item->updated_at,
                'action' => optional($item->created_at)->eq($item->updated_at) ? 'create' : 'update',
            ];
        });

        $kampus = Kampus::latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'kampus',
                'name' => $item->nama_kampus,
                'created_at' => $item->updated_at,
                'action' => optional($item->created_at)->eq($item->updated_at) ? 'create' : 'update',
            ];
        });

        $kampusJurusan = KampusJurusan::latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => 'kampus-jurusan',
                'name' => ($item->kampus->nama_kampus ?? '-') . ' - ' . ($item->jurusanKuliah->nama_jurusan_kuliah ?? '-'),
                'created_at' => $item->updated_at,
                'action' => optional($item->created_at)->eq($item->updated_at) ? 'create' : 'update',
            ];
        });

        $activities = $jurusanKuliah
            ->merge($kampus)
            ->merge($kampusJurusan)
            ->sortByDesc('created_at')
            ->take(10);

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.eksplorasi-kuliah', [
            'activities' => $activities,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }
}
