<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HobiJurusan extends Model
{
    protected $table = 'hobi_jurusans';

    protected $fillable = [
        'hobi_id',
        'jurusan_kuliah_id',
        'poin',
    ];

    public function hobi(): BelongsTo
    {
        return $this->belongsTo(Hobi::class, 'hobi_id');
    }

    public function jurusanKuliah(): BelongsTo
    {
        return $this->belongsTo(JurusanKuliah::class, 'jurusan_kuliah_id');
    }
}
