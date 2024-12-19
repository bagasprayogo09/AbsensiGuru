<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'guru_id');
    }


    public function getJumlahMengajarAttribute()
    {
        return $this->jadwal()->count();
    }


    /**
     * Get the absensis for the user.
     * Relasi ke absensi untuk setiap guru.
     */
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
