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
        'gaji',
        'deskripsi',
        'info_skill',
        'info_jurusan',
    ];

    public function opsiJawabans(): HasMany
    {
        return $this->hasMany(OpsiJawaban::class);
    }

    public function kenaliProfesi(): HasMany
    {
        return $this->hasMany(KenaliProfesi::class);
    }

    public function industris(): BelongsToMany
    {
        return $this->belongsToMany(Industri::class, 'industri_profesis', 'profesi_kerja_id', 'industri_id')->withTimestamps();
    }

    public function kategoriMinats(): BelongsToMany
    {
        return $this->belongsToMany(KategoriMinat::class, 'profesi_kategoris', 'profesi_kerja_id', 'kategori_minat_id')->withTimestamps();
    }
}
