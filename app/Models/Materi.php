<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'topik_materi_id',
        'nama_materi',
        'deskripsi_materi',
        'tipe_file',
        'file_materi',
    ];

    public function topikMateri(): BelongsTo
    {
        return $this->belongsTo(TopikMateri::class);
    }
}
