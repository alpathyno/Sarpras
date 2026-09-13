<?php
namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\Ruangan;
use App\Models\Aset;
use App\Models\JadwalRuangan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::where('user_id', Auth::id())->with('details.ruangan', 'details.aset');
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $peminjamans = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('user.peminjaman.index', compact('peminjamans'));
    }

    public function create(Request $request)
    {
        $jenis = $request->query('jenis', 'ruangan');
        
        $ruangans = Ruangan::where('dapat_dipinjam', 1)->where('status', 'Tersedia')->with('lantai.gedung')->get();
        $asets = Aset::where('dapat_dipinjam', 1)->where('status', 'Tersedia')->with('kategoriAset', 'ruangan')->get();
        
        return view('user.peminjaman.create', compact('jenis', 'ruangans', 'asets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:aset,ruangan',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required|string|max:500'
        ]);

        if ($request->jenis === 'ruangan') {
            $request->validate([
                'ruangan_id' => 'required|exists:ruangans,id'
            ]);

            // Cek konflik dengan jadwal statis
            $tglMulai = \Carbon\Carbon::parse($request->tanggal_mulai);
            $tglSelesai = \Carbon\Carbon::parse($request->tanggal_selesai);
            
            // Karena Jadwal Ruangan bersifat harian (tanggal tunggal, rentang waktu)
            // Kita cek untuk setiap hari dalam rentang peminjaman
            $days = $tglMulai->diffInDays($tglSelesai);
            for ($i = 0; $i <= $days; $i++) {
                $currentDate = $tglMulai->copy()->addDays($i)->format('Y-m-d');
                $konflikJadwal = JadwalRuangan::where('ruangan_id', $request->ruangan_id)
                    ->where('tanggal', $currentDate)
                    ->where(function($q) use ($tglMulai, $tglSelesai) {
                        $q->whereTime('jam_mulai', '<', $tglSelesai->format('H:i:s'))
                          ->whereTime('jam_selesai', '>', $tglMulai->format('H:i:s'));
                    })->exists();
                    
                if ($konflikJadwal) {
                    return back()->withInput()->with('error', 'Gagal: Terdapat jadwal kegiatan pada ruangan tersebut di tanggal ' . $currentDate);
                }
            }

            // Cek konflik dengan peminjaman ruangan lain yang sudah disetujui
            $konflikPeminjaman = PeminjamanDetail::where('ruangan_id', $request->ruangan_id)
                ->whereHas('peminjaman', function($q) use ($request) {
                    $q->where('status', 'Disetujui')
                      ->where('tanggal_mulai', '<', $request->tanggal_selesai)
                      ->where('tanggal_selesai', '>', $request->tanggal_mulai);
                })->exists();

            if ($konflikPeminjaman) {
                return back()->withInput()->with('error', 'Gagal: Ruangan sudah dipinjam dan disetujui pada rentang waktu tersebut.');
            }
            
        } else {
            $request->validate([
                'aset_id' => 'required|exists:asets,id',
                'jumlah' => 'required|integer|min:1'
            ]);

            $aset = Aset::findOrFail($request->aset_id);
            if ($aset->tipe_aset === 'individual' && $request->jumlah > 1) {
                return back()->withInput()->with('error', 'Aset individual hanya dapat dipinjam sebanyak 1.');
            }

            // Hitung ketersediaan (Aset dipinjam dan disetujui pada rentang tanggal)
            $dipinjam = PeminjamanDetail::where('aset_id', $aset->id)
                ->whereHas('peminjaman', function($q) use ($request) {
                    $q->where('status', 'Disetujui')
                      ->where('tanggal_mulai', '<', $request->tanggal_selesai)
                      ->where('tanggal_selesai', '>', $request->tanggal_mulai);
                })->sum('jumlah');

            if (($aset->jumlah - $dipinjam) < $request->jumlah) {
                return back()->withInput()->with('error', 'Gagal: Sisa ketersediaan aset pada tanggal tersebut tidak mencukupi (Tersedia: ' . ($aset->jumlah - $dipinjam) . ').');
            }
        }

        // Create Peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'jenis' => $request->jenis,
            'tanggal_pengajuan' => now()->toDateString(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tujuan' => $request->tujuan,
            'status' => 'Menunggu'
        ]);

        // Create Peminjaman Detail
        PeminjamanDetail::create([
            'peminjaman_id' => $peminjaman->id,
            'ruangan_id' => $request->jenis === 'ruangan' ? $request->ruangan_id : null,
            'aset_id' => $request->jenis === 'aset' ? $request->aset_id : null,
            'jumlah' => $request->jenis === 'aset' ? $request->jumlah : 1
        ]);

        // Notifikasi opsional ke admin? PRD bilang minimal ketika disetujui/ditolak.
        
        return redirect()->route('user.peminjaman.index')->with('success', 'Permohonan peminjaman berhasil diajukan. Menunggu persetujuan Admin.');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::where('user_id', Auth::id())
            ->with('details.ruangan', 'details.aset', 'admin', 'pengembalian')
            ->findOrFail($id);
            
        return view('user.peminjaman.show', compact('peminjaman'));
    }
}
