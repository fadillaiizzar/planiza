<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kampus extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kampus',
        'website',
        'alamat',
    ];

    public function jurusanKuliahs(): BelongsToMany
    {
        return $this->belongsToMany(JurusanKuliah::class, 'kampus_jurusans', 'kampus_id', 'jurusan_kuliah_id')->withTimestamps();
    }
}
