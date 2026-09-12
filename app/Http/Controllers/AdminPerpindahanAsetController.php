<?php
namespace App\Http\Controllers;

use App\Models\PerpindahanAset;
use App\Models\Aset;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPerpindahanAsetController extends Controller
{
    public function index(Request $request)
    {
        $query = PerpindahanAset::with(['aset', 'ruanganAsal', 'ruanganTujuan', 'user']);
        
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('aset', function($q) use ($request) {
                $q->where('nama_aset', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_aset', 'like', '%' . $request->search . '%');
            });
        }
        
        $perpindahans = $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.perpindahan_aset.index', compact('perpindahans'));
    }

    public function create()
    {
        // Hanya tampilkan aset yang Tersedia (tidak sedang dipinjam/diperbaiki/rusak berat)
        $asets = Aset::where('status', 'Tersedia')->where('dapat_dipinjam', 1)->with('ruangan')->get();
        $ruangans = Ruangan::all();
        return view('admin.perpindahan_aset.create', compact('asets', 'ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required|exists:asets,id',
            'ruangan_tujuan_id' => 'required|exists:ruangans,id',
            'tanggal' => 'required|date',
            'alasan' => 'required|string|max:500',
            'keterangan' => 'nullable|string'
        ]);

        $aset = Aset::findOrFail($request->aset_id);
        
        if ($aset->status !== 'Tersedia' || $aset->dapat_dipinjam == 0) {
            return back()->withInput()->with('error', 'Aset sedang tidak tersedia untuk dipindahkan (sedang dipinjam/rusak/diperbaiki).');
        }

        if ($aset->ruangan_id == $request->ruangan_tujuan_id) {
            return back()->withInput()->with('error', 'Ruangan tujuan tidak boleh sama dengan ruangan saat ini.');
        }

        DB::beginTransaction();
        try {
            // Rekam history perpindahan
            PerpindahanAset::create([
                'aset_id' => $aset->id,
                'ruangan_asal_id' => $aset->ruangan_id,
                'ruangan_tujuan_id' => $request->ruangan_tujuan_id,
                'tanggal' => $request->tanggal,
                'user_id' => Auth::id(),
                'alasan' => $request->alasan,
                'keterangan' => $request->keterangan
            ]);

            // Update master aset
            $aset->update([
                'ruangan_id' => $request->ruangan_tujuan_id
            ]);

            DB::commit();
            return redirect()->route('admin.perpindahan_aset.index')->with('success', 'Perpindahan aset berhasil dicatat dan lokasi master aset telah diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $perpindahan = PerpindahanAset::with(['aset', 'ruanganAsal', 'ruanganTujuan', 'user'])->findOrFail($id);
        return view('admin.perpindahan_aset.show', compact('perpindahan'));
    }
}