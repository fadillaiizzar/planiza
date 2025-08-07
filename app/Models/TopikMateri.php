<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TopikMateri extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'jurusan_id',
        'rencana_id',
        'judul_topik',
    ];

    public function materis(): HasMany {
        return $this->hasMany(Materi::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function rencana(): BelongsTo
    {
        return $this->belongsTo(Rencana::class);
    }
}
