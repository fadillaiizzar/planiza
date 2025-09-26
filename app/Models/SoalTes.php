<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoalTes extends Model
{
    protected $fillable = [
        'tes_id',
        'isi_pertanyaan',
        'jenis_soal',
        'max_select',
    ];

    public function opsiJawabans(): HasMany
    {
        return $this->hasMany(OpsiJawaban::class, 'soal_tes_id');
    }

    public function jawabanSiswas(): HasMany
    {
        return $this->hasMany(JawabanSiswa::class, 'soal_tes_id');
    }

    public function jawabanSiswa()
    {
        return $this->hasOne(JawabanSiswa::class, 'soal_tes_id')->where('user_id', Auth::id());
    }

    public function tes(): BelongsTo
    {
        return $this->belongsTo(Tes::class, 'tes_id');
    }
}
