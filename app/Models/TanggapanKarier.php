<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TanggapanKarier extends Model
{
    protected $table = 'tanggapan_kariers';

    protected $fillable = [
        'user_id',
        'bincang_karier_id',
        'isi_tanggapan'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bincangKarier(): BelongsTo
    {
        return $this->belongsTo(BincangKarier::class);
    }
}
