<?php
namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\JadwalRuangan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with('user', 'details.ruangan', 'details.aset');
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis', $request->jenis);
        }
        
        $peminjamans = $query->orderByRaw("FIELD(status, 'Menunggu') DESC")->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('user', 'details.ruangan', 'details.aset')->findOrFail($id);
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    public function approve(Request $request, $id)
    {
        $peminjaman = Peminjaman::with('details.ruangan', 'details.aset')->findOrFail($id);
        
        if ($peminjaman->status !== 'Menunggu') {
            return back()->with('error', 'Status peminjaman sudah diproses sebelumnya.');
        }

        // Pengecekan ulang sebelum approve (Race Condition check)
        if ($peminjaman->jenis === 'ruangan') {
            $ruangan_id = $peminjaman->details->first()->ruangan_id;
            $tglMulai = \Carbon\Carbon::parse($peminjaman->tanggal_mulai);
            $tglSelesai = \Carbon\Carbon::parse($peminjaman->tanggal_selesai);
            
            $days = $tglMulai->diffInDays($tglSelesai);
            for ($i = 0; $i <= $days; $i++) {
                $currentDate = $tglMulai->copy()->addDays($i)->format('Y-m-d');
                $konflikJadwal = JadwalRuangan::where('ruangan_id', $ruangan_id)
                    ->where('tanggal', $currentDate)
                    ->where(function($q) use ($tglMulai, $tglSelesai) {
                        $q->whereTime('waktu_mulai', '<', $tglSelesai->format('H:i:s'))
                          ->whereTime('waktu_selesai', '>', $tglMulai->format('H:i:s'));
                    })->exists();
                    
                if ($konflikJadwal) {
                    return back()->with('error', 'Gagal Approve: Terdapat jadwal baru yang menabrak rentang waktu ini.');
                }
            }

            $konflikPeminjaman = PeminjamanDetail::where('ruangan_id', $ruangan_id)
                ->whereHas('peminjaman', function($q) use ($peminjaman) {
                    $q->where('status', 'Disetujui')
                      ->where('tanggal_mulai', '<', $peminjaman->tanggal_selesai)
                      ->where('tanggal_selesai', '>', $peminjaman->tanggal_mulai);
                })->exists();

            if ($konflikPeminjaman) {
                return back()->with('error', 'Gagal Approve: Ruangan sudah disetujui untuk peminjaman lain pada waktu yang sama.');
            }
            
        } else {
            $detail = $peminjaman->details->first();
            $aset = $detail->aset;
            
            $dipinjam = PeminjamanDetail::where('aset_id', $aset->id)
                ->whereHas('peminjaman', function($q) use ($peminjaman) {
                    $q->where('status', 'Disetujui')
                      ->where('tanggal_mulai', '<', $peminjaman->tanggal_selesai)
                      ->where('tanggal_selesai', '>', $peminjaman->tanggal_mulai);
                })->sum('jumlah');

            if (($aset->jumlah - $dipinjam) < $detail->jumlah) {
                return back()->with('error', 'Gagal Approve: Ketersediaan aset saat ini tidak mencukupi.');
            }
        }

        $peminjaman->update([
            'status' => 'Disetujui',
            'disetujui_oleh' => Auth::id(),
            'catatan' => $request->catatan
        ]);

        Notifikasi::create([
            'user_id' => $peminjaman->user_id,
            'judul' => 'Peminjaman Disetujui',
            'pesan' => 'Permohonan peminjaman #' . $peminjaman->id . ' telah disetujui.',
            'dibaca' => false
        ]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $peminjaman->update([
            'status' => 'Ditolak',
            'disetujui_oleh' => Auth::id(),
            'catatan' => $request->catatan
        ]);

        Notifikasi::create([
            'user_id' => $peminjaman->user_id,
            'judul' => 'Peminjaman Ditolak',
            'pesan' => 'Permohonan peminjaman #' . $peminjaman->id . ' ditolak. Catatan: ' . $request->catatan,
            'dibaca' => false
        ]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman telah ditolak.');
    }
}