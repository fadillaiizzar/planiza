<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JawabanSiswa extends Model
{
    protected $fillable = [
        'user_id',
        'tes_id',
        'soal_tes_id',
        'opsi_jawaban_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tes(): BelongsTo
    {
        return $this->belongsTo(Tes::class);
    }

    public function soalTes(): BelongsTo
    {
        return $this->belongsTo(SoalTes::class);
    }

    public function opsiJawaban(): BelongsTo
    {
        return $this->belongsTo(OpsiJawaban::class);
    }
}
