<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    use HasFactory;
    protected $fillable = ['peminjaman_id', 'aset_id', 'ruangan_id', 'jumlah', 'keterangan'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
    public function aset()
    {
        return $this->belongsTo(Aset::class);
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
