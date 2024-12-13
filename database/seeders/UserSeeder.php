<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan beberapa pengguna
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'), // Ganti dengan password yang diinginkan
        ]);

        User::create([
            'name' => 'Guru User 1',
            'email' => 'guru1@example.com',
            'role' => 'guru',
            'password' => Hash::make('password'), // Ganti dengan password yang diinginkan
        ]);

        User::create([
            'name' => 'Guru User 2',
            'email' => 'guru2@example.com',
            'role' => 'guru',
            'password' => Hash::make('password'), // Ganti dengan password yang diinginkan
        ]);
    }
}
