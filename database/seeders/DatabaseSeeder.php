<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       // 1. Buat user admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'), // password: password
            'role' => 'admin',
        ]);

        // 2. Buat user siswa
        User::create([
            'name' => 'Siswa Satu',
            'username' => 'siswa1',
            'password' => Hash::make('password'), // password: password
            'role' => 'siswa',
        ]);
    }
}
