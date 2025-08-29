<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KenaliProfesi extends Model
{
    protected $fillable = [
        'user_id',
        'tes_id',
        'profesi_kerja_id',
        'sumber_rekomendasi',
        'total_poin',
        'ranking',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tes(): BelongsTo
    {
        return $this->belongsTo(Tes::class);
    }

    public function profesiKerja(): BelongsTo
    {
        return $this->belongsTo(ProfesiKerja::class);
    }
}
