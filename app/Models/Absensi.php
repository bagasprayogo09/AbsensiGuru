<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel akan secara otomatis menggunakan bentuk jamak)
    protected $table = 'absensis';

    // Kolom yang dapat diisi
    protected $fillable = [
        'guru_id',
        'jadwal_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'foto_keluar',
        'status',
        'keterangan',
    ];

    // Relasi dengan model Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(jadwal::class);
    }
}
