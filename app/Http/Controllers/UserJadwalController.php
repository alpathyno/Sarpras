<?php
namespace App\Http\Controllers;
use App\Models\JadwalRuangan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class UserJadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = JadwalRuangan::with('ruangan.lantai.gedung');
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('kegiatan', 'like', "%{$search}%")
                  ->orWhereHas('ruangan', function($q) use ($search) {
                      $q->where('nama_ruangan', 'like', "%{$search}%");
                  });
        }
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        } else {
            // Default to today and future if no date specified
            $query->whereDate('tanggal', '>=', now()->toDateString());
        }
        if ($request->has('ruangan_id') && $request->ruangan_id != '') {
            $query->where('ruangan_id', $request->ruangan_id);
        }
        
        $jadwals = $query->orderBy('tanggal', 'asc')->orderBy('jam_mulai')->paginate(15);
        $ruangans = Ruangan::where('dapat_dipinjam', 1)->with('lantai.gedung')->get();
        return view('user.jadwal.index', compact('jadwals', 'ruangans'));
    }
}
