<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';
    protected $fillable = ['user_id', 'jenis', 'tanggal_pengajuan', 'tanggal_mulai', 'tanggal_selesai', 'tujuan', 'status', 'disetujui_oleh', 'catatan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }
    public function details()
    {
        return $this->hasMany(PeminjamanDetail::class, 'peminjaman_id');
    }
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}
