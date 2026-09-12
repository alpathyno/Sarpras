<?php
namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
// use Maatwebsite\Excel\Facades\Excel; // If maatwebsite installed, but we can also use simpler CSV logic if needed. 

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
            return $this->exportCsvAset($asets);
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
            return $this->exportCsvPeminjaman($peminjamans);
        }

        return view('admin.laporan.peminjaman', compact('peminjamans'));
    }

    // A lightweight CSV exporter to avoid huge dependencies if Maatwebsite fails
    private function exportCsvAset($asets)
    {
        $filename = "Laporan_Aset_" . date('Y-m-d') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
        
        $columns = ['Kode Aset', 'Nama Aset', 'Kategori', 'Lokasi', 'Kondisi', 'Status'];

        $callback = function() use ($asets, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($asets as $a) {
                $lokasi = $a->ruangan ? $a->ruangan->nama_ruangan . ' (Gd.' . ($a->ruangan->lantai->gedung->nama_gedung ?? '') . ')' : 'Gudang';
                fputcsv($file, [
                    $a->kode_aset,
                    $a->nama_aset,
                    $a->kategoriAset->nama_kategori ?? '-',
                    $lokasi,
                    $a->kondisi,
                    $a->status
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportCsvPeminjaman($peminjamans)
    {
        $filename = "Laporan_Peminjaman_" . date('Y-m-d') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
        
        $columns = ['Tgl Pengajuan', 'Peminjam', 'Jenis', 'Item', 'Status'];

        $callback = function() use ($peminjamans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($peminjamans as $p) {
                $items = [];
                foreach($p->details as $d) {
                    if($p->jenis === 'ruangan') $items[] = $d->ruangan->nama_ruangan;
                    else $items[] = $d->aset->nama_aset . ' (x' . $d->jumlah . ')';
                }

                fputcsv($file, [
                    $p->tanggal_pengajuan,
                    $p->user->nama,
                    $p->jenis,
                    implode(', ', $items),
                    $p->status
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}