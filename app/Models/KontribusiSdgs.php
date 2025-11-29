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
        'durasi_kegiatan',
        'jenis_kegiatan',
        'peran',
        'bukti_upload',
        'tingkat_dampak',
        'status',
    ];

    protected $casts = [
        'bukti_upload' => 'array',
        'tanggal_pelaksanaan' => 'date',
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
