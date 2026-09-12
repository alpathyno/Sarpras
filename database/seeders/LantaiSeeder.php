<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Lantai;
use App\Models\Gedung;

class LantaiSeeder extends Seeder
{
    public function run(): void
    {
        $gedungA = Gedung::where('kode', 'A')->first();
        Lantai::create(['gedung_id' => $gedungA->id, 'nomor_lantai' => '1', 'keterangan' => 'Lantai Dasar']);
        Lantai::create(['gedung_id' => $gedungA->id, 'nomor_lantai' => '2', 'keterangan' => 'Lantai Dua']);

        $gedungB = Gedung::where('kode', 'B')->first();
        Lantai::create(['gedung_id' => $gedungB->id, 'nomor_lantai' => '1', 'keterangan' => 'Lantai Dasar Gedung B']);
    }
}
