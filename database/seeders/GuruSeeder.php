<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guru::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'pendidikan_terakhir' => 'S2 Pendidikan',
            'jurusan' => 'Pendidikan Matematika',
            'alamat' => 'Jl. Merdeka No. 10',
            'password' => Hash::make('password123'),
        ]);

        Guru::create([
            'name' => 'Siti Rahmawati',
            'email' => 'siti@example.com',
            'pendidikan_terakhir' => 'S1 Pendidikan',
            'jurusan' => 'Pendidikan Bahasa Inggris',
            'alamat' => 'Jl. Melati No. 5',
            'password' => Hash::make('password123'),
        ]);

        Guru::create([
            'name' => 'Ahmad Fauzan',
            'email' => 'ahmad@example.com',
            'pendidikan_terakhir' => 'S1 Pendidikan',
            'jurusan' => 'Pendidikan Fisika',
            'alamat' => 'Jl. Kenanga No. 8',
            'password' => Hash::make('password123'),
        ]);
    }
}
