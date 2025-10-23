<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HasilFormService
{
    public function getSummary(): Collection
    {
        return DB::table('form_kuliahs')
            ->join('users', 'form_kuliahs.user_id', '=', 'users.id')
            ->leftJoin('siswas', 'users.id', '=', 'siswas.user_id')
            ->leftJoin('kelas', 'siswas.kelas_id', '=', 'kelas.id')
            ->leftJoin('jurusans', 'siswas.jurusan_id', '=', 'jurusans.id') // <-- perbaikan
            ->select(
                'users.id as user_id',
                'users.name as nama_user',
                'kelas.nama_kelas',
                'jurusans.nama_jurusan',
                DB::raw('COUNT(form_kuliahs.id) as jumlah_pengerjaan'),
                DB::raw('MAX(form_kuliahs.updated_at) as update_terakhir')
            )
            ->groupBy('users.id', 'users.name', 'kelas.nama_kelas', 'jurusans.nama_jurusan')
            ->orderByDesc('update_terakhir')
            ->get();
    }

    public function getTotals(): array
    {
        $totals = DB::table('form_kuliahs')
            ->selectRaw('COUNT(DISTINCT user_id) as total_user, COUNT(*) as total_pengerjaan')
            ->first();

        return [
            'totalUser' => $totals->total_user,
            'totalPengerjaan' => $totals->total_pengerjaan,
        ];
    }

    public function getUserHistory($user_id): array
    {
        $userHistory = DB::table('form_kuliahs')
            ->where('user_id', $user_id)
            ->orderBy('updated_at', 'asc')
            ->get();

        $riwayat = $userHistory->map(function ($item, $index) {
            return [
                'ke' => $index + 1,
                'tanggal' => \Carbon\Carbon::parse($item->updated_at)->format('d M Y H:i'),
                'id_form' => $item->id,
            ];
        });

        return [
            'nama' => DB::table('users')->where('id', $user_id)->value('name'),
            'riwayat' => $riwayat,
            'total' => $riwayat->count(),
        ];
    }
}
