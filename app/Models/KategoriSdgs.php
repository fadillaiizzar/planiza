<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriSdgs extends Model
{
    protected $fillable = [
        'nomor_kategori',
        'nama_kategori',
        'deskripsi',
    ];
}
