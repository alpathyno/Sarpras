<?php
namespace App\Http\Controllers;

use App\Models\LaporanKerusakan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLaporanKerusakanController extends Controller
{
    public function index(Request $request)
    {
        $query = LaporanKerusakan::with('user', 'aset.ruangan.lantai.gedung');
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $laporans = $query->orderByRaw("FIELD(status, 'Dilaporkan') DESC")->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.laporan_kerusakan.index', compact('laporans'));
    }

    public function show($id)
    {
        $laporan = LaporanKerusakan::with('user', 'aset.ruangan.lantai.gedung')->findOrFail($id);
        return view('admin.laporan_kerusakan.show', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanKerusakan::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Diverifikasi,Dalam Perbaikan,Selesai,Ditolak',
            'catatan_admin' => 'nullable|string'
        ]);

        $laporan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin
        ]);

        // Kirim Notifikasi
        Notifikasi::create([
            'user_id' => $laporan->user_id,
            'judul' => 'Update Laporan Kerusakan',
            'pesan' => 'Laporan kerusakan aset (' . $laporan->aset->nama_aset . ') Anda sekarang berstatus: ' . $request->status . '.',
            'dibaca' => false
        ]);

        return redirect()->route('admin.laporan_kerusakan.index')->with('success', 'Status laporan berhasil diperbarui.');
    }
}