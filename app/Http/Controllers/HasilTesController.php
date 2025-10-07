<?php

namespace App\Http\Controllers;

use App\Models\Tes;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HasilTesController extends Controller
{
    public function index()
    {
        $data = Tes::withCount([
            // hitung jumlah user unik yang pernah mengerjakan tes
            'jawabanSiswas as jumlah_user' => function ($query) {
                $query->select(DB::raw('COUNT(DISTINCT user_id)'));
            },
            // hitung total jumlah pengerjaan (berdasarkan attempt)
            'jawabanSiswas as jumlah_pengerjaan' => function ($query) {
                $query->select(DB::raw('COUNT(DISTINCT CONCAT(user_id, "-", attempt))'));
            },
        ])
        ->with(['kenaliProfesis' => function ($q) {
            $q->latest('updated_at')->limit(1);
        }])
        ->get();

        return view('admin.pages.hasil-tes', compact('data'));
    }

    public function show($tes_id)
    {
        $tes = Tes::with(['jawabanSiswas.user', 'kenaliProfesis.profesiKerja'])
        ->findOrFail($tes_id);

        // Ambil semua user yang sudah pernah ngerjain tes ini
        $users = User::whereHas('hasilTes', function ($q) use ($tes_id) {
            $q->where('tes_id', $tes_id);
        })
        ->with(['hasilTes' => function ($q) use ($tes_id) {
            $q->where('tes_id', $tes_id)
            ->orderBy('created_at', 'asc');
        }])
        ->get();

        $result = [
            'tes' => $tes->nama_tes,
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'nama' => $user->name,
                    'pengerjaan' => $user->hasilTes->map(function ($hasil, $i) {
                        return [
                            'ke' => $i + 1,
                            'tanggal' => $hasil->created_at->format('d M Y'),
                            'skor' => $hasil->total_poin ?? '-',
                            'id_hasil' => $hasil->id,
                            'status' => $hasil->is_finished ? 'Selesai' : 'Belum',
                        ];
                    }),
                    'total_pengerjaan' => $user->hasilTes->count(),
                ];
            }),
        ];

        return response()->json($result);
    }

    public function showUsers($tes_id)
    {
        $tes = Tes::findOrFail($tes_id);

        $users = User::whereHas('hasilTes', function ($q) use ($tes_id) {
            $q->where('tes_id', $tes_id);
        })
        ->with([
            'siswa.kelas',
            'siswa.jurusan'
        ])
        ->withCount([
            'hasilTes as total_pengerjaan' => function ($q) use ($tes_id) {
                $q->select(DB::raw('COUNT(DISTINCT attempt)'))
                ->where('tes_id', $tes_id);
            }
        ])
        ->get();

        return view('admin.kenali_profesi.hasil_tes.hasil-tes-users', compact('tes', 'users'));
    }

    public function showUserHistory($tes_id, $user_id)
    {
        $user = User::with(['hasilTes' => function ($q) use ($tes_id) {
            $q->where('tes_id', $tes_id)
            ->orderBy('attempt', 'asc')
            ->orderBy('created_at', 'asc');
        }])->findOrFail($user_id);

        // Kelompokkan hasil per attempt
        $grouped = $user->hasilTes->groupBy('attempt');

        $riwayat = $grouped->map(function ($items, $attempt) {
            $first = $items->first();
            return [
                'ke' => $attempt,
                'tanggal' => $first->created_at->format('d M Y H:i:s'),
                'skor' => $items->avg('total_poin') ?? '-',
                'id_hasil' => $first->id,
                'jumlah_hasil' => $items->count(),
            ];
        })->values();

        return response()->json([
            'nama' => $user->name,
            'riwayat' => $riwayat,
            'total' => $riwayat->count(),
        ]);
    }
}
