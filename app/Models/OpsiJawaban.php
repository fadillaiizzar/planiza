<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OpsiJawaban extends Model
{
    protected $fillable = [
        'soal_tes_id',
        'kategori_minat_id',
        'profesi_kerja_id',
        'isi_opsi',
    ];

    public function jawabanSiswas(): HasMany
    {
        return $this->hasMany(JawabanSiswa::class);
    }

    public function soalTes(): BelongsTo
    {
        return $this->belongsTo(SoalTes::class);
    }

    public function kategoriMinat(): BelongsTo
    {
        return $this->belongsTo(KategoriMinat::class);
    }

    public function profesiKerja(): BelongsTo
    {
        return $this->belongsTo(ProfesiKerja::class);
    }
}
