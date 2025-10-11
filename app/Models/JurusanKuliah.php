<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JurusanKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jurusan_kuliah',
        'gambar',
        'deskripsi',
        'info_matkul',
        'info_prospek',
        'info_jurusan',
    ];

    public function kampus(): BelongsToMany
    {
        return $this->belongsToMany(Kampus::class, 'kampus_jurusans', 'jurusan_kuliah_id', 'kampus_id')->withTimestamps();
    }

    public function kampusJurusans()
    {
        return $this->hasMany(KampusJurusan::class, 'jurusan_kuliah_id');
    }

    public function kenaliJurusan(): HasMany
    {
        return $this->hasMany(KenaliJurusan::class);
    }
}
