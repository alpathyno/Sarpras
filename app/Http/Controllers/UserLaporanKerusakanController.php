<?php
namespace App\Http\Controllers;

use App\Models\LaporanKerusakan;
use App\Models\Aset;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserLaporanKerusakanController extends Controller
{
    public function index()
    {
        $laporans = LaporanKerusakan::where('user_id', Auth::id())
            ->with('aset.ruangan.lantai.gedung')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('user.laporan_kerusakan.index', compact('laporans'));
    }

    public function create()
    {
        // Only show assets that are currently not completely broken/afkir or already under repair if possible. 
        // We just list all assets so they can report it.
        $asets = Aset::with('ruangan.lantai.gedung')->get();
        return view('user.laporan_kerusakan.create', compact('asets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required|exists:asets,id',
            'deskripsi' => 'required|string|max:1000',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('kerusakan', 'public');
        }

        $laporan = LaporanKerusakan::create([
            'user_id' => Auth::id(),
            'aset_id' => $request->aset_id,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'tanggal_laporan' => now()->toDateString(),
            'status' => 'Dilaporkan'
        ]);

        return redirect()->route('user.laporan_kerusakan.index')->with('success', 'Laporan kerusakan berhasil dikirim.');
    }

    public function show($id)
    {
        $laporan = LaporanKerusakan::where('user_id', Auth::id())
            ->with('aset.ruangan.lantai.gedung')
            ->findOrFail($id);
            
        return view('user.laporan_kerusakan.show', compact('laporan'));
    }
}