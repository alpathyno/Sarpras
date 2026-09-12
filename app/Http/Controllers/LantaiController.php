<?php
namespace App\Http\Controllers;
use App\Models\Lantai;
use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LantaiController extends Controller
{
    public function index(Request $request)
    {
        $query = Lantai::with('gedung');
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nomor_lantai', 'like', "%{$search}%")
                  ->orWhereHas('gedung', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('kode', 'like', "%{$search}%");
                  });
        }
        if ($request->has('gedung_id') && $request->gedung_id != '') {
            $query->where('gedung_id', $request->gedung_id);
        }
        
        $lantais = $query->paginate(10);
        $gedungs = Gedung::all();
        return view('admin.lantai.index', compact('lantais', 'gedungs'));
    }

    public function create()
    {
        $gedungs = Gedung::all();
        return view('admin.lantai.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gedung_id' => 'required|exists:gedungs,id',
            'nomor_lantai' => [
                'required',
                'string',
                Rule::unique('lantais')->where(function ($query) use ($request) {
                    return $query->where('gedung_id', $request->gedung_id);
                })
            ],
            'keterangan' => 'nullable|string'
        ]);

        Lantai::create($request->all());
        return redirect()->route('admin.lantai.index')->with('success', 'Lantai berhasil ditambahkan.');
    }

    public function edit(Lantai $lantai)
    {
        $gedungs = Gedung::all();
        return view('admin.lantai.edit', compact('lantai', 'gedungs'));
    }

    public function update(Request $request, Lantai $lantai)
    {
        $request->validate([
            'gedung_id' => 'required|exists:gedungs,id',
            'nomor_lantai' => [
                'required',
                'string',
                Rule::unique('lantais')->where(function ($query) use ($request) {
                    return $query->where('gedung_id', $request->gedung_id);
                })->ignore($lantai->id)
            ],
            'keterangan' => 'nullable|string'
        ]);

        $lantai->update($request->all());
        return redirect()->route('admin.lantai.index')->with('success', 'Lantai berhasil diperbarui.');
    }

    public function destroy(Lantai $lantai)
    {
        if ($lantai->ruangans()->count() > 0) {
            return redirect()->route('admin.lantai.index')->with('error', 'Lantai tidak dapat dihapus karena memiliki data ruangan.');
        }
        $lantai->delete();
        return redirect()->route('admin.lantai.index')->with('success', 'Lantai berhasil dihapus.');
    }
}