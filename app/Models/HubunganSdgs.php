<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HubunganSdgs extends Model
{
    protected $fillable = [
        'kategori_sdgs_id',
        'profesi_kerja_id',
        'jurusan_kuliah_id',
    ];
}
