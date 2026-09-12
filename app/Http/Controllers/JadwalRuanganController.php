<?php
namespace App\Http\Controllers;
use App\Models\JadwalRuangan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class JadwalRuanganController extends Controller
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
        }
        if ($request->has('ruangan_id') && $request->ruangan_id != '') {
            $query->where('ruangan_id', $request->ruangan_id);
        }
        
        $jadwals = $query->orderBy('tanggal', 'desc')->orderBy('waktu_mulai')->paginate(10);
        $ruangans = Ruangan::with('lantai.gedung')->get();
        return view('admin.jadwal_ruangan.index', compact('jadwals', 'ruangans'));
    }

    public function create()
    {
        $ruangans = Ruangan::with('lantai.gedung')->get();
        return view('admin.jadwal_ruangan.create', compact('ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'keterangan' => 'nullable|string'
        ]);

        if ($this->cekKonflik($request->ruangan_id, $request->tanggal, $request->waktu_mulai, $request->waktu_selesai)) {
            return back()->withInput()->with('error', 'Jadwal bentrok dengan jadwal lain pada ruangan, tanggal, dan waktu tersebut.');
        }

        JadwalRuangan::create($request->all());
        return redirect()->route('admin.jadwal_ruangan.index')->with('success', 'Jadwal ruangan berhasil ditambahkan.');
    }

    public function edit(JadwalRuangan $jadwalRuangan)
    {
        $ruangans = Ruangan::with('lantai.gedung')->get();
        return view('admin.jadwal_ruangan.edit', compact('jadwalRuangan', 'ruangans'));
    }

    public function update(Request $request, JadwalRuangan $jadwalRuangan)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'keterangan' => 'nullable|string'
        ]);

        if ($this->cekKonflik($request->ruangan_id, $request->tanggal, $request->waktu_mulai, $request->waktu_selesai, $jadwalRuangan->id)) {
            return back()->withInput()->with('error', 'Jadwal bentrok dengan jadwal lain pada ruangan, tanggal, dan waktu tersebut.');
        }

        $jadwalRuangan->update($request->all());
        return redirect()->route('admin.jadwal_ruangan.index')->with('success', 'Jadwal ruangan berhasil diperbarui.');
    }

    public function destroy(JadwalRuangan $jadwalRuangan)
    {
        $jadwalRuangan->delete();
        return redirect()->route('admin.jadwal_ruangan.index')->with('success', 'Jadwal ruangan berhasil dihapus.');
    }

    private function cekKonflik($ruangan_id, $tanggal, $mulai, $selesai, $ignore_id = null)
    {
        $query = JadwalRuangan::where('ruangan_id', $ruangan_id)
            ->where('tanggal', $tanggal)
            ->where(function($q) use ($mulai, $selesai) {
                $q->where(function($q2) use ($mulai, $selesai) {
                    $q2->whereTime('waktu_mulai', '<', $selesai)
                       ->whereTime('waktu_selesai', '>', $mulai);
                });
            });
            
        if ($ignore_id) {
            $query->where('id', '!=', $ignore_id);
        }
        
        return $query->exists();
    }
}