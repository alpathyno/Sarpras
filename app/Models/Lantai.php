<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;
    protected $fillable = ['gedung_id', 'nomor_lantai', 'keterangan'];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }
    public function ruangans()
    {
        return $this->hasMany(Ruangan::class);
    }
}
