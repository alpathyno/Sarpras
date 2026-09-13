<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $peminjamans;

    public function __construct($peminjamans)
    {
        $this->peminjamans = $peminjamans;
    }

    public function collection()
    {
        return $this->peminjamans;
    }

    public function headings(): array
    {
        return [
            'Tgl Pengajuan',
            'Peminjam',
            'Jenis',
            'Item',
            'Status'
        ];
    }

    public function map($peminjaman): array
    {
        $items = [];
        foreach($peminjaman->details as $d) {
            if($peminjaman->jenis === 'ruangan') {
                $items[] = $d->ruangan->nama_ruangan ?? '-';
            } else {
                $items[] = ($d->aset->nama_aset ?? '-') . ' (x' . $d->jumlah . ')';
            }
        }

        return [
            $peminjaman->tanggal_pengajuan,
            $peminjaman->user->nama,
            $peminjaman->jenis,
            implode(', ', $items),
            $peminjaman->status
        ];
    }
}
