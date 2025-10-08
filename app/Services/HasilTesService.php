<?php
namespace App\Services;

use App\Models\Tes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class HasilTesService
{
    /**
     * Ambil rekap semua Tes beserta dua count khusus.
     * Mengembalikan Collection of Tes model (dengan atribut jumlah_user & jumlah_pengerjaan).
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSummary(): Collection
    {
        return Tes::withCount([
            'jawabanSiswas as jumlah_user' => function ($query) {
                $query->select(DB::raw('COUNT(DISTINCT user_id)'));
            },
            'jawabanSiswas as jumlah_pengerjaan' => function ($query) {
                $query->select(DB::raw('COUNT(DISTINCT CONCAT(user_id, "-", attempt))'));
            },
        ])
        ->with(['kenaliProfesis' => function ($q) {
            $q->latest('updated_at')->limit(1);
        }])
        ->get();
    }

    /**
     * Opsi filter dropdown (distinct nama_tes).
     *
     * @return array
     */
    public function getFilterOptions(): array
    {
        return Tes::select('nama_tes')
            ->distinct()
            ->orderBy('nama_tes', 'asc')
            ->get()
            ->map(fn($tes) => [
                'label' => $tes->nama_tes,
                'value' => $tes->nama_tes
            ])->toArray();
    }

    /**
     * Ambil collection User yang pernah mengerjakan $tesId.
     * Hanya memuat hasilTes yang sesuai $tesId (ordered).
     *
     * @param int|string $tesId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsersByTes($tesId): Collection
    {
        return User::whereHas('hasilTes', function ($q) use ($tesId) {
                $q->where('tes_id', $tesId);
            })
            ->with(['hasilTes' => function ($q) use ($tesId) {
                $q->where('tes_id', $tesId)
                  ->orderBy('created_at', 'asc');
            }])
            ->get();
    }

    /**
     * Untuk tampilan admin (showUsers): ambil users dengan relasi siswa, kelas, jurusan dan total_pengerjaan
     *
     * @param int|string $tesId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsersForView($tesId): Collection
    {
        return User::whereHas('hasilTes', function ($q) use ($tesId) {
                $q->where('tes_id', $tesId);
            })
            ->with(['siswa.kelas', 'siswa.jurusan'])
            ->withCount([
                'hasilTes as total_pengerjaan' => function ($q) use ($tesId) {
                    $q->select(DB::raw('COUNT(DISTINCT attempt)'))
                      ->where('tes_id', $tesId);
                }
            ])
            ->get();
    }

    /**
     * Ambil riwayat pengerjaan user untuk tes tertentu (grouped by attempt).
     *
     * @param int|string $tesId
     * @param int|string $userId
     * @return array
     */
    public function getUserHistory($tesId, $userId): array
    {
        $user = User::with(['hasilTes' => function ($q) use ($tesId) {
                $q->where('tes_id', $tesId)
                  ->orderBy('attempt', 'asc')
                  ->orderBy('created_at', 'asc');
            }])->findOrFail($userId);

        $grouped = $user->hasilTes->groupBy('attempt');

        $riwayat = $grouped->map(function ($items, $attempt) {
            $first = $items->first();
            return [
                'ke' => (int) $attempt,
                'tanggal' => $first->created_at->format('d M Y H:i:s'),
                'skor' => $items->avg('total_poin') ?? '-',
                'id_hasil' => $first->id,
                'jumlah_hasil' => $items->count(),
            ];
        })->values();

        return [
            'nama' => $user->name,
            'riwayat' => $riwayat,
            'total' => $riwayat->count(),
        ];
    }

    /**
     * Ambil detail attempt: jawaban per soal (gabungan profesi via GROUP_CONCAT)
     * dan total poin per profesi (kenali_profesis).
     *
     * @param int|string $tesId
     * @param int|string $userId
     * @param int|string $attempt
     * @return array
     */
    public function getAttemptDetail($tesId, $userId, $attempt): array
    {
        $tes = Tes::findOrFail($tesId);
        $user = User::findOrFail($userId);

        // Query jawaban (sama logikanya seperti query sebelumnya — tetap di service)
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
            ->where('jawaban_siswas.tes_id', $tesId)
            ->where('jawaban_siswas.user_id', $userId)
            ->where('jawaban_siswas.attempt', $attempt)
            ->groupBy('soal_tes.id', 'soal_tes.isi_pertanyaan', 'opsi_jawabans.isi_opsi', 'opsi_jawabans.poin')
            ->orderBy('soal_tes.id', 'asc')
            ->get();

        // kelompokkan berdasarkan soal_id
        $jawaban = $rawJawaban->groupBy('soal_id')->map(function ($items) {
            $pertanyaan = $items->first()->isi_pertanyaan;

            $listJawaban = $items->map(function ($item) {
                return [
                    'isi_opsi' => $item->isi_opsi,
                    'poin' => $item->poin,
                    'profesi_tujuan' => $item->profesi_tujuan,
                ];
            })->values();

            return [
                'pertanyaan' => $pertanyaan,
                'jawaban' => $listJawaban,
            ];
        })->values();

        // Ambil poin per profesi dari tabel kenali_profesis
        $poinProfesi = DB::table('kenali_profesis')
            ->join('profesi_kerjas', 'kenali_profesis.profesi_kerja_id', '=', 'profesi_kerjas.id')
            ->select('profesi_kerjas.nama_profesi_kerja', 'kenali_profesis.total_poin')
            ->where('kenali_profesis.user_id', $userId)
            ->where('kenali_profesis.tes_id', $tesId)
            ->where('kenali_profesis.attempt', $attempt)
            ->orderByDesc('kenali_profesis.total_poin')
            ->get();

        $topProfesi = $poinProfesi->take(3);

        return [
            'tes' => $tes,
            'user' => $user,
            'jawaban' => $jawaban,
            'poinProfesi' => $poinProfesi,
            'topProfesi' => $topProfesi,
            'attempt' => $attempt,
        ];
    }
}
