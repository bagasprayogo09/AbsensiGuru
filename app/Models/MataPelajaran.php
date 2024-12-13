<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'nama_pelajaran',

    ];

     /**
     * Mendapatkan guru yang mengajarkan mata pelajaran ini.
     */

     public function guru()
     {
        return $this->belongsTo(User::class,'user_id');
     }

     public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
