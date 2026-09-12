<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $fillable = ['peminjaman_id', 'tanggal_kembali', 'diterima_oleh', 'kondisi_saat_kembali', 'catatan'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'diterima_oleh');
    }
}
