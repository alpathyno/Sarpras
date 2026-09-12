<?php
namespace App\Http\Controllers;
use App\Models\Gedung;
use Illuminate\Http\Request;
class GedungController extends Controller
{
    public function index(Request $request)
    {
        $query = Gedung::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('kode', 'like', "%{$search}%");
        }
        $gedungs = $query->paginate(10);
        return view('admin.gedung.index', compact('gedungs'));
    }
    public function create()
    {
        return view('admin.gedung.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:gedungs,kode',
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);
        Gedung::create($request->all());
        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil ditambahkan.');
    }
    public function edit(Gedung $gedung)
    {
        return view('admin.gedung.edit', compact('gedung'));
    }
    public function update(Request $request, Gedung $gedung)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:gedungs,kode,' . $gedung->id,
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);
        $gedung->update($request->all());
        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil diperbarui.');
    }
    public function destroy(Gedung $gedung)
    {
        if ($gedung->lantais()->count() > 0) {
            return redirect()->route('admin.gedung.index')->with('error', 'Gedung tidak dapat dihapus karena memiliki data lantai.');
        }
        $gedung->delete();
        return redirect()->route('admin.gedung.index')->with('success', 'Gedung berhasil dihapus.');
    }
}