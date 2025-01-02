<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajarans';

    protected $fillable = ['nama'];

    // Relasi dengan Jadwal jika diperlukan
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
