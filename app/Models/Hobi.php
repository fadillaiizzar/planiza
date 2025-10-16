<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Hobi extends Model
{
    protected $table = 'hobis';

    protected $fillable = [
        'nama_hobi',
    ];

    public function jurusanKuliahs(): BelongsToMany
    {
        return $this->belongsToMany(JurusanKuliah::class, 'hobi_jurusans', 'hobi_id', 'jurusan_kuliah_id')->withTimestamps();
    }

    public function hobiJurusans(): HasMany
    {
        return $this->hasMany(HobiJurusan::class, 'hobi_id');
    }

    public function minats(): HasMany
    {
        return $this->hasMany(Minat::class);
    }
}
