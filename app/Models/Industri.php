<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Industri extends Model
{
    use HasFactory;

    protected $table = 'industris';

    protected $fillable = [
        'nama_industri',
        'website',
        'alamat',
    ];

    public function profesiKerjas(): BelongsToMany
    {
        return $this->belongsToMany(ProfesiKerja::class, 'industri_profesis', 'industri_id', 'profesi_kerja_id')->withTimestamps()->withPivot('gaji');
    }
}
