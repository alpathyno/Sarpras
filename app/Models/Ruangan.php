<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $fillable = ['lantai_id', 'kode_ruangan', 'nama_ruangan', 'jenis', 'kapasitas', 'dapat_dipinjam', 'status'];

    public function lantai()
    {
        return $this->belongsTo(Lantai::class);
    }
    public function asets()
    {
        return $this->hasMany(Aset::class);
    }
    public function jadwalRuangans()
    {
        return $this->hasMany(JadwalRuangan::class);
    }
    public function peminjamanDetails()
    {
        return $this->hasMany(PeminjamanDetail::class);
    }
}
