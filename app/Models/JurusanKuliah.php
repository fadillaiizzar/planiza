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
        return $this->belongsToMany(Kampus::class, 'kampus_jurusans', 'jurusan_kuliah_id', 'kampus_id')->withPivot('passing_grade')->withTimestamps();
    }

    public function kampusJurusans(): HasMany
    {
        return $this->hasMany(KampusJurusan::class, 'jurusan_kuliah_id');
    }

    public function hobis(): BelongsToMany
    {
        return $this->belongsToMany(Hobi::class, 'hobi_jurusans', 'jurusan_kuliah_id', 'hobi_id')->withTimestamps()->withPivot('poin');
    }

    public function kenaliJurusans(): HasMany
    {
        return $this->hasMany(KenaliJurusan::class);
    }

    public function minats(): HasMany
    {
        return $this->hasMany(Minat::class);
    }
}
