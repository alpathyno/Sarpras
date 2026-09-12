<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalRuangan extends Model
{
    use HasFactory;
    protected $fillable = ['ruangan_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'kegiatan', 'keterangan'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
