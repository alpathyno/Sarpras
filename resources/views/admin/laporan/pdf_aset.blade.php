<!DOCTYPE html>
<html>
<head>
    <title>Laporan Aset</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; padding: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEM INFORMASI MANAJEMEN SARANA DAN PRASARANA</h2>
        <h3>LAPORAN INVENTARIS ASET</h3>
        <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asets as $i => $a)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $a->kode_aset }}</td>
                <td>{{ $a->nama_aset }}</td>
                <td>{{ $a->kategoriAset->nama_kategori ?? '-' }}</td>
                <td>{{ $a->ruangan ? $a->ruangan->nama_ruangan . ' (Gd.' . ($a->ruangan->lantai->gedung->nama_gedung ?? '') . ')' : 'Gudang' }}</td>
                <td>{{ $a->kondisi }}</td>
                <td>{{ $a->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
