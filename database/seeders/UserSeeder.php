<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'nama' => 'Administrator',
            'email' => 'admin@simsarpras.test',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'nama' => 'Dosen Fulan',
            'email' => 'dosen@simsarpras.test',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'dosen',
        ]);

        \App\Models\User::create([
            'nama' => 'Mahasiswa Fulan',
            'email' => 'mahasiswa@simsarpras.test',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'mahasiswa',
        ]);
    }
}
