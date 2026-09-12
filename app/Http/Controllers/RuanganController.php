<?php
namespace App\Http\Controllers;
use App\Models\Ruangan;
use App\Models\Lantai;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Ruangan::with('lantai.gedung');
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_ruangan', 'like', "%{$search}%")
                  ->orWhere('kode_ruangan', 'like', "%{$search}%");
        }
        if ($request->has('lantai_id') && $request->lantai_id != '') {
            $query->where('lantai_id', $request->lantai_id);
        }
        
        $ruangans = $query->paginate(10);
        $lantais = Lantai::with('gedung')->get();
        return view('admin.ruangan.index', compact('ruangans', 'lantais'));
    }

    public function create()
    {
        $lantais = Lantai::with('gedung')->get();
        return view('admin.ruangan.create', compact('lantais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lantai_id' => 'required|exists:lantais,id',
            'kode_ruangan' => 'required|string|unique:ruangans,kode_ruangan',
            'nama_ruangan' => 'required|string',
            'jenis' => 'required|string',
            'kapasitas' => 'required|integer|min:0',
            'dapat_dipinjam' => 'required|boolean',
            'status' => 'required|string'
        ]);

        Ruangan::create($request->all());
        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Ruangan $ruangan)
    {
        $lantais = Lantai::with('gedung')->get();
        return view('admin.ruangan.edit', compact('ruangan', 'lantais'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'lantai_id' => 'required|exists:lantais,id',
            'kode_ruangan' => 'required|string|unique:ruangans,kode_ruangan,' . $ruangan->id,
            'nama_ruangan' => 'required|string',
            'jenis' => 'required|string',
            'kapasitas' => 'required|integer|min:0',
            'dapat_dipinjam' => 'required|boolean',
            'status' => 'required|string'
        ]);

        $ruangan->update($request->all());
        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        if ($ruangan->asets()->count() > 0 || $ruangan->jadwalRuangans()->count() > 0) {
            return redirect()->route('admin.ruangan.index')->with('error', 'Ruangan tidak dapat dihapus karena masih digunakan oleh aset atau jadwal.');
        }
        $ruangan->delete();
        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}