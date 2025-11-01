<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
