<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KontribusiSdgs extends Model
{
    protected $fillable = [
        'user_id',
        'kategori_sdgs_id',
        'judul_kegiatan',
        'deskripsi_refleksi',
        'tanggal_pelaksanaan',
        'bukti_upload',
        'status',
    ];

    protected $casts = [
        'bukti_upload' => 'array', 
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kategoriSdgs(): BelongsTo
    {
        return $this->belongsTo(KategoriSdgs::class);
    }
}
