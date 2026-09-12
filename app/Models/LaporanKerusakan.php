<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKerusakan extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'aset_id', 'deskripsi', 'foto', 'tanggal_laporan', 'status', 'catatan_admin'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function aset()
    {
        return $this->belongsTo(Aset::class);
    }
    public function pemeliharaan()
    {
        return $this->hasOne(Pemeliharaan::class);
    }
}
