<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Aset;
use App\Models\KategoriAset;
use App\Models\Ruangan;

class AsetSeeder extends Seeder
{
    public function run(): void
    {
        $katFurnitur = KategoriAset::where('nama_kategori', 'Furnitur')->first();
        $katElektronik = KategoriAset::where('nama_kategori', 'Elektronik')->first();
        
        $rSidang = Ruangan::where('kode_ruangan', 'A102')->first();
        $rKelas = Ruangan::where('kode_ruangan', 'A201')->first();

        Aset::create([
            'kategori_id' => $katFurnitur->id,
            'ruangan_id' => $rSidang->id,
            'kode_aset' => 'FURN-001',
            'nama_aset' => 'Kursi Rapat',
            'tipe_aset' => 'jumlah',
            'jumlah' => 20,
            'kondisi' => 'Baik',
            'dapat_dipinjam' => false,
            'status' => 'Tersedia'
        ]);

        Aset::create([
            'kategori_id' => $katElektronik->id,
            'ruangan_id' => $rKelas->id,
            'kode_aset' => 'ELEC-001',
            'nama_aset' => 'Proyektor Epson',
            'tipe_aset' => 'individual',
            'jumlah' => 1,
            'kondisi' => 'Baik',
            'dapat_dipinjam' => true,
            'status' => 'Tersedia'
        ]);
        
        Aset::create([
            'kategori_id' => $katElektronik->id,
            'ruangan_id' => null,
            'kode_aset' => 'ELEC-002',
            'nama_aset' => 'Laptop Asus ROG',
            'tipe_aset' => 'individual',
            'jumlah' => 1,
            'kondisi' => 'Baik',
            'dapat_dipinjam' => true,
            'status' => 'Tersedia',
            'keterangan' => 'Berada di ruang penyimpanan Admin'
        ]);
    }
}
