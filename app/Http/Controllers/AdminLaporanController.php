<?php
namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class AdminLaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function aset(Request $request)
    {
        $query = Aset::with('kategoriAset', 'ruangan.lantai.gedung');
        
        if ($request->kondisi) {
            $query->where('kondisi', $request->kondisi);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $asets = $query->get();

        if ($request->export === 'pdf') {
            $pdf = Pdf::loadView('admin.laporan.pdf_aset', compact('asets'))->setPaper('a4', 'landscape');
            return $pdf->download('Laporan_Aset_SIM_Sarpras.pdf');
        }

        if ($request->export === 'excel') {
            $filename = 'Laporan_Aset_SIM_Sarpras_' . date('Y-m-d') . '.xlsx';
            return Excel::download(new \App\Exports\AsetExport($asets), $filename);
        }

        return view('admin.laporan.aset', compact('asets'));
    }

    public function peminjaman(Request $request)
    {
        $query = Peminjaman::with('user', 'details.aset', 'details.ruangan');
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal_pengajuan', [$request->start_date, $request->end_date]);
        }

        $peminjamans = $query->orderBy('tanggal_pengajuan', 'desc')->get();

        if ($request->export === 'pdf') {
            $pdf = Pdf::loadView('admin.laporan.pdf_peminjaman', compact('peminjamans', 'request'))->setPaper('a4', 'landscape');
            return $pdf->download('Laporan_Peminjaman_SIM_Sarpras.pdf');
        }

        if ($request->export === 'excel') {
            $filename = 'Laporan_Peminjaman_SIM_Sarpras_' . date('Y-m-d') . '.xlsx';
            return Excel::download(new \App\Exports\PeminjamanExport($peminjamans), $filename);
        }

        return view('admin.laporan.peminjaman', compact('peminjamans'));
    }
}