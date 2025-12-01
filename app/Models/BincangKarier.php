<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BincangKarier extends Model
{
    protected $table = 'bincang_kariers';

    protected $fillable = [
        'user_id',
        'isi_pertanyaan'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tanggapanKarier(): HasMany
    {
        return $this->hasMany(TanggapanKarier::class);
    }
}
