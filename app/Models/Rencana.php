<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rencana extends Model
{
    use HasFactory;

    protected $fillable = ['nama_rencana'];

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }

    public function topikMateris(): HasMany
    {
        return $this->hasMany(TopikMateri::class);
    }
}
