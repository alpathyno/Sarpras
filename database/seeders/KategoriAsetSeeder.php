<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\KategoriAset;

class KategoriAsetSeeder extends Seeder
{
    public function run(): void
    {
        KategoriAset::create(['nama_kategori' => 'Furnitur', 'keterangan' => 'Aset berupa perabotan seperti kursi dan meja']);
        KategoriAset::create(['nama_kategori' => 'Elektronik', 'keterangan' => 'Aset elektronik dan perangkat IT']);
        KategoriAset::create(['nama_kategori' => 'Perlengkapan', 'keterangan' => 'Perlengkapan kantor dan kelas']);
    }
}
