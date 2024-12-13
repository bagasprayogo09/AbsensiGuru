<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwals')->insert([
            [
                'hari' => 'Rabu',
                'jumlah_jam' => 4,
                'mata_pelajaran_id' => 1, // Ganti dengan ID mata pelajaran yang sesuai
                'guru_id' => 2, // Ganti dengan ID guru yang sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Tambahkan data lainnya sesuai kebutuhan
        ]);
    }
}
