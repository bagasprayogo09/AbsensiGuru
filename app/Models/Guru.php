<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Guru extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password','pendidikan_terakhir','alamat','jurusan'];
    protected $hidden   = ['password', 'remember_token'];

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'guru_id');
    }
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'guru_id');
    }
}

