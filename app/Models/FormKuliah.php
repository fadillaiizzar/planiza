<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormKuliah extends Model
{
    protected $fillable = [
        'user_id',
        'attempt',
        'nilai_utbk',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function minats(): HasMany
    {
        return $this->hasMany(Minat::class);
    }
}
