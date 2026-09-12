<?php
namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use App\Models\LaporanKerusakan;
use App\Models\Pemeliharaan;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard($user);
        }
    }

    private function adminDashboard()
    {
        // 1. Total Aset
        $totalAset = Aset::count();
        
        // 2. Aset Berdasarkan Kondisi
        $kondisiBaik = Aset::where('kondisi', 'Baik')->count();
        $kondisiRusakRingan = Aset::where('kondisi', 'Rusak Ringan')->count();
        $kondisiRusakBerat = Aset::where('kondisi', 'Rusak Berat')->count();
        
        // 3. Aset Sedang Dipinjam
        $asetDipinjam = PeminjamanDetail::whereNotNull('aset_id')
            ->whereHas('peminjaman', function($q) {
                $q->where('status', 'Disetujui');
            })->sum('jumlah');

        // 4. Aset Sedang Diperbaiki
        $asetDiperbaiki = Pemeliharaan::where('status', 'Sedang Berjalan')->count();
        
        // 5. Laporan Kerusakan
        $totalLaporan = LaporanKerusakan::count();
        $laporanBaru = LaporanKerusakan::where('status', 'Dilaporkan')->count();
        
        // 6. Peminjaman Berdasarkan Status
        $peminjamanStats = [
            'Pending' => Peminjaman::where('status', 'Menunggu')->count(),
            'Aktif' => Peminjaman::where('status', 'Disetujui')->count(),
            'Selesai' => Peminjaman::where('status', 'Selesai')->count(),
            'Ditolak' => Peminjaman::where('status', 'Ditolak')->count(),
        ];
        
        // 7. Aktivitas Terbaru (Peminjaman Terakhir)
        $recentActivities = Peminjaman::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard.admin', compact(
            'totalAset', 'kondisiBaik', 'kondisiRusakRingan', 'kondisiRusakBerat',
            'asetDipinjam', 'asetDiperbaiki', 'totalLaporan', 'laporanBaru',
            'peminjamanStats', 'recentActivities'
        ));
    }

    private function userDashboard($user)
    {
        $totalPeminjaman = Peminjaman::where('user_id', $user->id)->count();
        $peminjamanPending = Peminjaman::where('user_id', $user->id)->where('status', 'Menunggu')->count();
        $peminjamanAktif = Peminjaman::where('user_id', $user->id)->where('status', 'Disetujui')->count();
        
        $recentPeminjaman = Peminjaman::where('user_id', $user->id)
            ->with('details.aset', 'details.ruangan')
            ->orderBy('created_at', 'desc')
            ->take(5)->get();
            
        $totalLaporan = LaporanKerusakan::where('user_id', $user->id)->count();

        return view('dashboard.user', compact(
            'totalPeminjaman', 'peminjamanPending', 'peminjamanAktif',
            'recentPeminjaman', 'totalLaporan'
        ));
    }
}