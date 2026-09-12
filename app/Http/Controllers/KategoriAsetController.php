<?php
namespace App\Http\Controllers;
use App\Models\KategoriAset;
use Illuminate\Http\Request;

class KategoriAsetController extends Controller
{
    public function index(Request $request)
    {
        $query = KategoriAset::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_kategori', 'like', "%{$search}%");
        }
        $kategoris = $query->paginate(10);
        return view('admin.kategori_aset.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori_aset.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_asets,nama_kategori',
            'keterangan' => 'nullable|string'
        ]);

        KategoriAset::create($request->all());
        return redirect()->route('admin.kategori_aset.index')->with('success', 'Kategori Aset berhasil ditambahkan.');
    }

    public function edit(KategoriAset $kategoriAset)
    {
        return view('admin.kategori_aset.edit', compact('kategoriAset'));
    }

    public function update(Request $request, KategoriAset $kategoriAset)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_asets,nama_kategori,' . $kategoriAset->id,
            'keterangan' => 'nullable|string'
        ]);

        $kategoriAset->update($request->all());
        return redirect()->route('admin.kategori_aset.index')->with('success', 'Kategori Aset berhasil diperbarui.');
    }

    public function destroy(KategoriAset $kategoriAset)
    {
        if ($kategoriAset->asets()->count() > 0) {
            return redirect()->route('admin.kategori_aset.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki aset.');
        }
        $kategoriAset->delete();
        return redirect()->route('admin.kategori_aset.index')->with('success', 'Kategori Aset berhasil dihapus.');
    }
}