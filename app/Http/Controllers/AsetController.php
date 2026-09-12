<?php
namespace App\Http\Controllers;
use App\Models\Aset;
use App\Models\KategoriAset;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $query = Aset::with(['kategoriAset', 'ruangan.lantai.gedung']);
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_aset', 'like', "%{$search}%")
                  ->orWhere('kode_aset', 'like', "%{$search}%");
        }
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }
        if ($request->has('ruangan_id') && $request->ruangan_id != '') {
            $query->where('ruangan_id', $request->ruangan_id);
        }
        
        $asets = $query->paginate(10);
        $kategoris = KategoriAset::all();
        $ruangans = Ruangan::with('lantai.gedung')->get();
        return view('admin.aset.index', compact('asets', 'kategoris', 'ruangans'));
    }

    public function create()
    {
        $kategoris = KategoriAset::all();
        $ruangans = Ruangan::with('lantai.gedung')->get();
        return view('admin.aset.create', compact('kategoris', 'ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_asets,id',
            'ruangan_id' => 'nullable|exists:ruangans,id',
            'kode_aset' => 'required|string|unique:asets,kode_aset',
            'nama_aset' => 'required|string|max:255',
            'tipe_aset' => 'required|in:individual,jumlah',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|string',
            'dapat_dipinjam' => 'required|boolean',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'keterangan' => 'nullable|string'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('asets', 'public');
        }

        Aset::create($data);
        return redirect()->route('admin.aset.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function edit(Aset $aset)
    {
        $kategoris = KategoriAset::all();
        $ruangans = Ruangan::with('lantai.gedung')->get();
        return view('admin.aset.edit', compact('aset', 'kategoris', 'ruangans'));
    }

    public function update(Request $request, Aset $aset)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_asets,id',
            'ruangan_id' => 'nullable|exists:ruangans,id',
            'kode_aset' => 'required|string|unique:asets,kode_aset,' . $aset->id,
            'nama_aset' => 'required|string|max:255',
            'tipe_aset' => 'required|in:individual,jumlah',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|string',
            'dapat_dipinjam' => 'required|boolean',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'keterangan' => 'nullable|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($aset->foto && Storage::disk('public')->exists($aset->foto)) {
                Storage::disk('public')->delete($aset->foto);
            }
            $data['foto'] = $request->file('foto')->store('asets', 'public');
        }

        $aset->update($data);
        return redirect()->route('admin.aset.index')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Aset $aset)
    {
        if ($aset->peminjamanDetails()->count() > 0 || $aset->laporanKerusakans()->count() > 0 || $aset->pemeliharaans()->count() > 0 || $aset->perpindahanAsets()->count() > 0) {
            return redirect()->route('admin.aset.index')->with('error', 'Aset tidak dapat dihapus karena terkait dengan data transaksi.');
        }

        if ($aset->foto && Storage::disk('public')->exists($aset->foto)) {
            Storage::disk('public')->delete($aset->foto);
        }
        $aset->delete();
        return redirect()->route('admin.aset.index')->with('success', 'Aset berhasil dihapus.');
    }
}