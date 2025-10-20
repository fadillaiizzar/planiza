<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndustriProfesi extends Model
{
    use HasFactory;

    protected $table = 'industri_profesis';

    protected $fillable = [
        'profesi_kerja_id',
        'industri_id',
        'gaji',
    ];

    public function profesiKerja(): BelongsTo
    {
        return $this->belongsTo(ProfesiKerja::class, 'profesi_kerja_id');
    }

    public function industri(): BelongsTo
    {
        return $this->belongsTo(Industri::class, 'industri_id');
    }
}
