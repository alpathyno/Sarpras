<?php
namespace App\Http\Controllers;

use App\Models\Pemeliharaan;
use App\Models\LaporanKerusakan;
use App\Models\Aset;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class AdminPemeliharaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemeliharaan::with('aset', 'laporanKerusakan.user');
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $pemeliharaans = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pemeliharaan.index', compact('pemeliharaans'));
    }

    public function create(Request $request)
    {
        $laporan_id = $request->query('laporan_id');
        $aset_id = $request->query('aset_id');
        
        $laporan = null;
        if ($laporan_id) {
            $laporan = LaporanKerusakan::find($laporan_id);
        }
        
        $asets = Aset::all();
        return view('admin.pemeliharaan.create', compact('asets', 'laporan', 'aset_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required|exists:asets,id',
            'laporan_kerusakan_id' => 'nullable|exists:laporan_kerusakans,id',
            'tanggal_mulai' => 'required|date',
            'deskripsi' => 'required|string',
            'biaya' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        Pemeliharaan::create([
            'aset_id' => $request->aset_id,
            'laporan_kerusakan_id' => $request->laporan_kerusakan_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'deskripsi' => $request->deskripsi,
            'status' => 'Direncanakan',
            'biaya' => $request->biaya ?? 0,
            'keterangan' => $request->keterangan
        ]);

        // Kunci ketersediaan aset agar tidak bisa dipinjam
        $aset = Aset::findOrFail($request->aset_id);
        $aset->update([
            'dapat_dipinjam' => 0,
            'status' => 'Diperbaiki'
        ]);

        if ($request->laporan_kerusakan_id) {
            $laporan = LaporanKerusakan::find($request->laporan_kerusakan_id);
            $laporan->update(['status' => 'Dalam Perbaikan']);
            
            Notifikasi::create([
                'user_id' => $laporan->user_id,
                'judul' => 'Perbaikan Dimulai',
                'pesan' => 'Aset (' . $aset->nama_aset . ') yang Anda laporkan saat ini sedang dalam proses perbaikan.',
                'dibaca' => false
            ]);
        }

        return redirect()->route('admin.pemeliharaan.index')->with('success', 'Tiket pemeliharaan berhasil dibuat. Aset dikunci dari peminjaman.');
    }

    public function edit($id)
    {
        $pemeliharaan = Pemeliharaan::with('aset', 'laporanKerusakan')->findOrFail($id);
        return view('admin.pemeliharaan.edit', compact('pemeliharaan'));
    }

    public function update(Request $request, $id)
    {
        $pemeliharaan = Pemeliharaan::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Direncanakan,Sedang Berjalan,Selesai',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'biaya' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
            'kondisi_aset_final' => 'nullable|required_if:status,Selesai|string'
        ]);

        $pemeliharaan->update([
            'status' => $request->status,
            'tanggal_selesai' => $request->status === 'Selesai' ? ($request->tanggal_selesai ?? now()->toDateString()) : null,
            'biaya' => $request->biaya ?? $pemeliharaan->biaya,
            'keterangan' => $request->keterangan
        ]);

        if ($request->status === 'Selesai') {
            $aset = $pemeliharaan->aset;
            
            // Buka kembali ketersediaan aset jika bukan rusak berat
            $dapatDipinjam = $request->kondisi_aset_final === 'Rusak Berat' ? 0 : 1;
            $statusAset = $request->kondisi_aset_final === 'Rusak Berat' ? 'Rusak' : 'Tersedia';

            $aset->update([
                'kondisi' => $request->kondisi_aset_final,
                'dapat_dipinjam' => $dapatDipinjam,
                'status' => $statusAset
            ]);

            if ($pemeliharaan->laporan_kerusakan_id) {
                $laporan = $pemeliharaan->laporanKerusakan;
                $laporan->update(['status' => 'Selesai']);
                
                Notifikasi::create([
                    'user_id' => $laporan->user_id,
                    'judul' => 'Perbaikan Selesai',
                    'pesan' => 'Perbaikan aset (' . $aset->nama_aset . ') telah selesai.',
                    'dibaca' => false
                ]);
            }
        }

        return redirect()->route('admin.pemeliharaan.index')->with('success', 'Status pemeliharaan diperbarui.');
    }

    public function show($id)
    {
        $pemeliharaan = Pemeliharaan::with('aset', 'laporanKerusakan.user')->findOrFail($id);
        return view('admin.pemeliharaan.show', compact('pemeliharaan'));
    }
}