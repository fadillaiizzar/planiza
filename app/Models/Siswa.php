<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'kelas_id', 
        'jurusan_id', 
        'rencana_id',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas(): BelongsTo  
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jurusan(): BelongsTo  
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function rencana(): BelongsTo  
    {
        return $this->belongsTo(Rencana::class);
    }
}
