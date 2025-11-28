<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfesiKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_profesi_kerja',
        'gambar',
        'deskripsi',
        'info_skill',
        'info_jurusan',
    ];

    // Relasi Fitur Eksplorasi Profesi
    public function industris(): BelongsToMany
    {
        return $this->belongsToMany(Industri::class, 'industri_profesis', 'profesi_kerja_id', 'industri_id')->withPivot('gaji')->withTimestamps();
    }

    public function industriProfesis(): HasMany
    {
        return $this->hasMany(IndustriProfesi::class, 'profesi_kerja_id');
    }

    // Relasi Fitur Kenali Profesi
    public function opsiJawabans(): HasMany
    {
        return $this->hasMany(OpsiJawaban::class);
    }

    public function kenaliProfesi(): HasMany
    {
        return $this->hasMany(KenaliProfesi::class);
    }

    public function kategoriMinats(): BelongsToMany
    {
        return $this->belongsToMany(KategoriMinat::class, 'profesi_kategoris', 'profesi_kerja_id', 'kategori_minat_id')->withTimestamps();
    }

    // Relasi Fitur SDGs
    public function hubunganSdgs(): HasMany
    {
        return $this->hasMany(HubunganSdgs::class, 'profesi_kerja_id');
    }

    public function kategoriSdgs(): BelongsToMany
    {
        return $this->belongsToMany(KategoriSdgs::class, 'hubungan_sdgs', 'profesi_kerja_id', 'kategori_sdgs_id')->withTimestamps();
    }
}
