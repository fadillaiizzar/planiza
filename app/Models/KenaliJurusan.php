<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KenaliJurusan extends Model
{
    protected $fillable = [
        'user_id',
        'kampus_jurusan_id',
        'jurusan_kuliah_id',
        'sumber_rekomendasi',
        'status_peluang',
        'attempt'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kampusJurusan(): BelongsTo
    {
        return $this->belongsTo(KampusJurusan::class);
    }

    public function jurusanKuliah(): BelongsTo
    {
        return $this->belongsTo(JurusanKuliah::class);
    }
}
