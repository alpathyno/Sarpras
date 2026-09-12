<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Aset;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPengembalianController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with('user', 'details.ruangan', 'details.aset', 'pengembalian')
            ->whereIn('status', ['Disetujui', 'Selesai']);
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $peminjamans = $query->orderByRaw("FIELD(status, 'Disetujui') DESC")->orderBy('tanggal_mulai', 'asc')->paginate(10);
        return view('admin.pengembalian.index', compact('peminjamans'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('user', 'details.ruangan', 'details.aset', 'pengembalian')
            ->whereIn('status', ['Disetujui', 'Selesai'])
            ->findOrFail($id);
            
        return view('admin.pengembalian.show', compact('peminjaman'));
    }

    public function process(Request $request, $id)
    {
        $peminjaman = Peminjaman::with('details.aset')->findOrFail($id);
        
        if ($peminjaman->status !== 'Disetujui') {
            return back()->with('error', 'Peminjaman tidak valid untuk dikembalikan (status bukan Disetujui).');
        }

        $request->validate([
            'tanggal_kembali' => 'required|date|before_or_equal:today',
            'kondisi_saat_kembali' => 'nullable|string',
            'catatan' => 'nullable|string'
        ]);

        // Simpan data pengembalian
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_kembali' => $request->tanggal_kembali,
            'diterima_oleh' => Auth::id(),
            'kondisi_saat_kembali' => $request->kondisi_saat_kembali,
            'catatan' => $request->catatan
        ]);

        // Ubah status peminjaman menjadi Selesai
        $peminjaman->update(['status' => 'Selesai']);

        // Update master aset condition jika peminjaman berupa aset dan kondisinya diubah
        if ($peminjaman->jenis === 'aset' && $request->kondisi_saat_kembali) {
            foreach ($peminjaman->details as $detail) {
                if ($detail->aset) {
                    $detail->aset->update([
                        'kondisi' => $request->kondisi_saat_kembali
                    ]);
                }
            }
        }

        // Notifikasi ke user
        Notifikasi::create([
            'user_id' => $peminjaman->user_id,
            'judul' => 'Pengembalian Dikonfirmasi',
            'pesan' => 'Pengembalian atas peminjaman #' . $peminjaman->id . ' telah dikonfirmasi oleh Admin.',
            'dibaca' => false
        ]);

        return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian berhasil dikonfirmasi dan status diubah menjadi Selesai.');
    }
}
