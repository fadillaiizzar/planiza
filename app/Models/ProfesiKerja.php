<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProfesiKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_profesi_kerja',
        'gambar',
        'gaji',
        'deskripsi',
        'info_skill',
        'info_jurusan',
    ];

    public function industris(): BelongsToMany
    {
        return $this->belongsToMany(Industri::class, 'industri_profesis', 'profesi_kerja_id', 'industri_id');
    }
}
