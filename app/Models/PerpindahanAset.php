<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerpindahanAset extends Model
{
    use HasFactory;
    protected $fillable = ['aset_id', 'ruangan_asal_id', 'ruangan_tujuan_id', 'tanggal', 'user_id', 'alasan', 'keterangan'];

    public function aset()
    {
        return $this->belongsTo(Aset::class);
    }
    public function ruanganAsal()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_asal_id');
    }
    public function ruanganTujuan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_tujuan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
