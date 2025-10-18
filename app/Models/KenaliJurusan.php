<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KenaliJurusan extends Model
{
    protected $fillable = [
        'user_id',
        'form_kuliah_id',
        'jurusan_kuliah_id',
        'sumber_rekomendasi',
        'status_peluang',
        'attempt'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function formKuliah(): BelongsTo
    {
        return $this->belongsTo(FormKuliah::class);
    }

    public function jurusanKuliah(): BelongsTo
    {
        return $this->belongsTo(JurusanKuliah::class);
    }
}
