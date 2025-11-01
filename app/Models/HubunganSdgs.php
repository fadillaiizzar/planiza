<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HubunganSdgs extends Model
{
    protected $table = 'hubungan_sdgs';

    protected $fillable = [
        'kategori_sdgs_id',
        'profesi_kerja_id',
        'jurusan_kuliah_id',
    ];

    public function kategoriSdgs(): BelongsTo
    {
        return $this->belongsTo(KategoriSdgs::class, 'kategori_sdgs_id');
    }

    public function profesiKerja(): BelongsTo
    {
        return $this->belongsTo(ProfesiKerja::class, 'profesi_kerja_id');
    }

    public function jurusanKuliah(): BelongsTo
    {
        return $this->belongsTo(JurusanKuliah::class, 'jurusan_kuliah_id');
    }
}
