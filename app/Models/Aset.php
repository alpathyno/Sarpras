<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    protected $fillable = ['kategori_id', 'ruangan_id', 'kode_aset', 'nama_aset', 'tipe_aset', 'jumlah', 'kondisi', 'dapat_dipinjam', 'status', 'foto', 'keterangan'];

    public function kategoriAset()
    {
        return $this->belongsTo(KategoriAset::class, 'kategori_id');
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
    public function peminjamanDetails()
    {
        return $this->hasMany(PeminjamanDetail::class);
    }
    public function laporanKerusakans()
    {
        return $this->hasMany(LaporanKerusakan::class);
    }
    public function pemeliharaans()
    {
        return $this->hasMany(Pemeliharaan::class);
    }
    public function perpindahanAsets()
    {
        return $this->hasMany(PerpindahanAset::class);
    }
}
