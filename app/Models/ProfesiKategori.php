<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfesiKategori extends Model
{
    use HasFactory;

    protected $table = 'profesi_kategoris';

    protected $fillable = [
        'profesi_kerja_id',
        'kategori_minat_id',
    ];

    protected $with = ['profesiKerja', 'kategoriMinat'];

    public function profesiKerja(): BelongsTo
    {
        return $this->belongsTo(ProfesiKerja::class, 'profesi_kerja_id');
    }

    public function kategoriMinat(): BelongsTo
    {
        return $this->belongsTo(KategoriMinat::class, 'kategori_minat_id');
    }
}
