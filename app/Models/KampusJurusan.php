<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KampusJurusan extends Model
{
    use HasFactory;

    protected $table = 'kampus_jurusans';

    protected $fillable = [
        'jurusan_kuliah_id',
        'kampus_id',
        'passing_grade',
    ];

    protected $with = ['jurusanKuliah', 'kampus'];

    public function jurusanKuliah(): BelongsTo
    {
        return $this->belongsTo(JurusanKuliah::class, 'jurusan_kuliah_id');
    }

    public function kampus(): BelongsTo
    {
        return $this->belongsTo(Kampus::class, 'kampus_id');
    }
}
