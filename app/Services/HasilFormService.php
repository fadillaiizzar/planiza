<?php

namespace App\Services;

use App\Models\FormKuliah;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class HasilFormService
{
    public function getSummary(): Collection
    {
        return FormKuliah::withCount([
            'minats as jumlah_user' => function ($query) {
                $query->select(DB::raw('COUNT(DISTINCT user_id)'));
            },
            'minats as jumlah_pengerjaan' => function ($query) {
                $query->select(DB::raw('COUNT(DISTINCT CONCAT(user_id, "-", attempt))'));
            },
        ])
        ->with(['kenaliJurusans' => function ($q) {
            $q->latest('updated_at')->limit(1);
        }])
        ->get();
    }
}
