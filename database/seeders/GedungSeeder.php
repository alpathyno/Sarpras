<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Gedung;

class GedungSeeder extends Seeder
{
    public function run(): void
    {
        Gedung::create(['kode' => 'A', 'nama' => 'Gedung A', 'keterangan' => 'Gedung Utama']);
        Gedung::create(['kode' => 'B', 'nama' => 'Gedung B', 'keterangan' => 'Gedung Kuliah Bersama']);
        Gedung::create(['kode' => 'C', 'nama' => 'Gedung C', 'keterangan' => 'Gedung Laboratorium']);
    }
}
