<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Minat extends Model
{
    protected $fillable = [
        'form_kuliah_id',
        'jurusan_kuliah_id',
        'hobi_jurusan_id',
        'attempt',
        'is_finished'
    ];

    public function formKuliah(): BelongsTo
    {
        return $this->belongsTo(FormKuliah::class);
    }

    public function jurusanKuliah(): BelongsTo
    {
        return $this->belongsTo(JurusanKuliah::class);
    }

    public function hobiJurusan(): BelongsTo
    {
        return $this->belongsTo(HobiJurusan::class);
    }
}
