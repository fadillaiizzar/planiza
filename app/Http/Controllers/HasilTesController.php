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

    public function showAttempt($tes_id, $user_id, $attempt)
    {
        $tes = Tes::findOrFail($tes_id);
        $user = User::findOrFail($user_id);

        // Ambil semua jawaban
        $rawJawaban = DB::table('jawaban_siswas')
            ->join('soal_tes', 'jawaban_siswas.soal_tes_id', '=', 'soal_tes.id')
            ->join('opsi_jawabans', 'jawaban_siswas.opsi_jawaban_id', '=', 'opsi_jawabans.id')
            ->leftJoin('kategori_minats', 'opsi_jawabans.kategori_minat_id', '=', 'kategori_minats.id')
            ->leftJoin('profesi_kategoris', 'kategori_minats.id', '=', 'profesi_kategoris.kategori_minat_id')
            ->leftJoin('profesi_kerjas as profesi_kat', 'profesi_kategoris.profesi_kerja_id', '=', 'profesi_kat.id')
            ->leftJoin('profesi_kerjas as profesi_opsi', 'opsi_jawabans.profesi_kerja_id', '=', 'profesi_opsi.id')
            ->select(
                'soal_tes.id as soal_id',
                'soal_tes.isi_pertanyaan',
                'opsi_jawabans.isi_opsi',
                'opsi_jawabans.poin',
                DB::raw("
                    TRIM(BOTH ', ' FROM CONCAT_WS(
                        ', ',
                        GROUP_CONCAT(DISTINCT profesi_opsi.nama_profesi_kerja SEPARATOR ', '),
                        GROUP_CONCAT(DISTINCT profesi_kat.nama_profesi_kerja SEPARATOR ', ')
                    )) as profesi_tujuan
                ")
            )
            ->where('jawaban_siswas.tes_id', $tes_id)
            ->where('jawaban_siswas.user_id', $user_id)
            ->where('jawaban_siswas.attempt', $attempt)
            ->groupBy('soal_tes.id', 'soal_tes.isi_pertanyaan', 'opsi_jawabans.isi_opsi', 'opsi_jawabans.poin')
            ->orderBy('soal_tes.id', 'asc')
            ->get();

        // 🔹 Kelompokkan berdasarkan pertanyaan
        $jawaban = $rawJawaban->groupBy('soal_id')->map(function ($items) {
            $pertanyaan = $items->first()->isi_pertanyaan;

            $listJawaban = $items->map(function ($item) {
                return [
                    'isi_opsi' => $item->isi_opsi,
                    'poin' => $item->poin,
                    'profesi_tujuan' => $item->profesi_tujuan,
                ];
            });

            return [
                'pertanyaan' => $pertanyaan,
                'jawaban' => $listJawaban,
            ];
        });

        // Ambil total poin per profesi
        $poinProfesi = DB::table('kenali_profesis')
            ->join('profesi_kerjas', 'kenali_profesis.profesi_kerja_id', '=', 'profesi_kerjas.id')
            ->select('profesi_kerjas.nama_profesi_kerja', 'kenali_profesis.total_poin')
            ->where('kenali_profesis.user_id', $user_id)
            ->where('kenali_profesis.tes_id', $tes_id)
            ->where('kenali_profesis.attempt', $attempt)
            ->orderByDesc('kenali_profesis.total_poin')
            ->get();

        $topProfesi = $poinProfesi->take(3);

        return view('admin.kenali_profesi.hasil_tes.detail-attempt', compact(
            'tes', 'user', 'jawaban', 'poinProfesi', 'topProfesi', 'attempt'
        ));
    }
}
