<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mata_pelajarans')->insert([
            [
                'guru_id' => 2, // Ganti dengan ID guru yang sesuai
                'nama_pelajaran' => 'Matematika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
