<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'tanggal',
        'status',
        'jam_masuk',
        'jam_keluar',
        'foto_jam_keluar'
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'guru_id'); // guru_id di Absensi merujuk ke id di User
    }
}
