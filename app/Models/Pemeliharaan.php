<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    use HasFactory;
    protected $fillable = ['aset_id', 'laporan_kerusakan_id', 'tanggal_mulai', 'tanggal_selesai', 'deskripsi', 'status', 'biaya', 'keterangan'];

    public function aset()
    {
        return $this->belongsTo(Aset::class);
    }
    public function laporanKerusakan()
    {
        return $this->belongsTo(LaporanKerusakan::class);
    }
}
