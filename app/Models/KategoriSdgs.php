<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriSdgs extends Model
{
    protected $fillable = [
        'nomor_kategori',
        'nama_kategori',
        'deskripsi',
    ];

    public function kontribusiSdgs(): HasMany
    {
        return $this->hasMany(KontribusiSdgs::class);
    }

    public function hubunganSdgs(): HasMany
    {
        return $this->hasMany(HubunganSdgs::class, 'kategori_sdgs_id');
    }

    public function profesiKerjas()
    {
        return $this->belongsToMany(ProfesiKerja::class,
            'hubungan_sdgs',
            'kategori_sdgs_id',
            'profesi_kerja_id'
        );
    }

    public function jurusanKuliahs()
    {
        return $this->belongsToMany(JurusanKuliah::class,
            'hubungan_sdgs',
            'kategori_sdgs_id',
            'jurusan_kuliah_id'
        );
    }
}
