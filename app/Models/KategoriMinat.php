<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KategoriMinat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    public function profesiKerjas(): BelongsToMany
    {
        return $this->belongsToMany(ProfesiKerja::class, 'profesi_kategoris', 'kategori_minat_id', 'profesi_kerja_id')->withTimestamps();
    }
}
