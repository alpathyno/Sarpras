<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AsetExport implements FromCollection, WithHeadings, WithMapping
{
    protected $asets;

    public function __construct($asets)
    {
        $this->asets = $asets;
    }

    public function collection()
    {
        return $this->asets;
    }

    public function headings(): array
    {
        return [
            'Kode Aset',
            'Nama Aset',
            'Kategori',
            'Lokasi',
            'Kondisi',
            'Status'
        ];
    }

    public function map($aset): array
    {
        $lokasi = $aset->ruangan ? $aset->ruangan->nama_ruangan . ' (Gd.' . ($aset->ruangan->lantai->gedung->nama ?? '') . ')' : 'Gudang';

        return [
            $aset->kode_aset,
            $aset->nama_aset,
            $aset->kategoriAset->nama_kategori ?? '-',
            $lokasi,
            $aset->kondisi,
            $aset->status
        ];
    }
}
