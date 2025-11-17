<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['role', 'siswa'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function scopeHasTes($query, $tesId)
    {
        return $query->whereHas('hasilTes', function ($q) use ($tesId) {
            $q->where('tes_id', $tesId);
        });
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class);
    }

    public function hasilTes(): HasMany
    {
        return $this->hasMany(KenaliProfesi::class);
    }

    public function formKuliahs(): HasMany
    {
        return $this->hasMany(FormKuliah::class);
    }

    public function kenaliProfesis()
    {
        return $this->hasMany(KenaliProfesi::class, 'user_id');
    }

    public function kenaliJurusans(): HasMany
    {
        return $this->hasMany(KenaliJurusan::class, 'user_id');
    }

    public function kontribusiSdgs(): HasMany
    {
        return $this->hasMany(KontribusiSdgs::class);
    }
}
