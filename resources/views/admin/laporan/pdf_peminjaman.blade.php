<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
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
        <h3>LAPORAN PEMINJAMAN ASET & RUANGAN</h3>
        <p>
            Periode: {{ $request->start_date ?? 'Semua' }} s/d {{ $request->end_date ?? 'Semua' }}<br>
            Dicetak pada: {{ now()->format('d F Y H:i') }}
        </p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Pengajuan</th>
                <th>Peminjam</th>
                <th>Jenis</th>
                <th>Item Peminjaman</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d/m/Y') }}</td>
                <td>{{ $p->user->nama }}</td>
                <td>{{ ucfirst($p->jenis) }}</td>
                <td>
                    @foreach($p->details as $d)
                        @if($p->jenis === 'ruangan') {{ $d->ruangan->nama_ruangan }}
                        @else {{ $d->aset->nama_aset }} (x{{ $d->jumlah }}) @endif
                        <br>
                    @endforeach
                </td>
                <td>{{ $p->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
