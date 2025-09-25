<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tes extends Model
{
    protected $table = 'tes';
    protected $fillable = ['nama_tes', 'is_active'];

    public function soalTes(): HasMany
    {
        return $this->hasMany(SoalTes::class);
    }

    public function jawabanSiswas(): HasMany
    {
        return $this->hasMany(JawabanSiswa::class);
    }

    public function kenaliProfesis(): HasMany
    {
        return $this->hasMany(KenaliProfesi::class);
    }
}
