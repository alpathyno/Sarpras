<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Ruangan;
use App\Models\Lantai;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $lantai1A = Lantai::whereHas('gedung', function($q) { $q->where('kode', 'A'); })->where('nomor_lantai', '1')->first();
        $lantai2A = Lantai::whereHas('gedung', function($q) { $q->where('kode', 'A'); })->where('nomor_lantai', '2')->first();
        $lantai1B = Lantai::whereHas('gedung', function($q) { $q->where('kode', 'B'); })->where('nomor_lantai', '1')->first();

        Ruangan::create(['lantai_id' => $lantai1A->id, 'kode_ruangan' => 'A101', 'nama_ruangan' => 'Ruang Dosen A101', 'jenis' => 'Ruang dosen', 'kapasitas' => 10, 'dapat_dipinjam' => false, 'status' => 'Tersedia']);
        Ruangan::create(['lantai_id' => $lantai1A->id, 'kode_ruangan' => 'A102', 'nama_ruangan' => 'Ruang Sidang A102', 'jenis' => 'Ruang sidang', 'kapasitas' => 20, 'dapat_dipinjam' => true, 'status' => 'Tersedia']);
        Ruangan::create(['lantai_id' => $lantai2A->id, 'kode_ruangan' => 'A201', 'nama_ruangan' => 'Ruang Kelas A201', 'jenis' => 'Ruang kelas', 'kapasitas' => 40, 'dapat_dipinjam' => true, 'status' => 'Tersedia']);
        Ruangan::create(['lantai_id' => $lantai1B->id, 'kode_ruangan' => 'B101', 'nama_ruangan' => 'Laboratorium Komputer', 'jenis' => 'Laboratorium', 'kapasitas' => 30, 'dapat_dipinjam' => true, 'status' => 'Tersedia']);
    }
}
