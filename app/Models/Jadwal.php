<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Jadwal extends Model
{
    protected $table = 'jadwals';

    protected $fillable = [
        'guru_id',
        'mata_pelajaran_id',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    // Relasi dengan Mata Pelajaran
    // Model Jadwal
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    // Relasi dengan Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // Relasi dengan Absensi
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    // Accessor untuk hari dalam bahasa Indonesia
    public function getHariIndonesiaAttribute()
    {
        $hariIndonesia = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];

        return $hariIndonesia[$this->hari] ?? $this->hari;
    }
}
