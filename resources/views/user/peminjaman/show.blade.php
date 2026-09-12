@extends('layouts.app')
@section('title', 'Detail Peminjaman - SIM Sarpras')
@section('page_title', 'Detail Peminjaman')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0">Detail Peminjaman #{{ $peminjaman->id }}</h5>
            <a href="{{ route('user.peminjaman.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="35%">Tgl Pengajuan</th>
                        <td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_pengajuan)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            @if($peminjaman->status === 'Menunggu') <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                            @elseif($peminjaman->status === 'Disetujui') <span class="badge bg-success">Disetujui</span>
                            @elseif($peminjaman->status === 'Selesai') <span class="badge bg-primary">Selesai</span>
                            @else <span class="badge bg-danger">Ditolak</span> @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Jadwal Mulai</th>
                        <td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Jadwal Selesai</th>
                        <td>: {{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Tujuan Kegiatan</th>
                        <td>: {{ $peminjaman->tujuan }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Item yang Dipinjam ({{ ucfirst($peminjaman->jenis) }})</h6>
                        <ul class="list-group list-group-flush">
                            @foreach($peminjaman->details as $d)
                                <li class="list-group-item bg-transparent px-0 border-bottom-0">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    @if($peminjaman->jenis === 'ruangan')
                                        {{ $d->ruangan->nama_ruangan }} (Kapasitas: {{ $d->ruangan->kapasitas }})
                                    @else
                                        {{ $d->aset->nama_aset }} - <strong>Jumlah: {{ $d->jumlah }}</strong>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                @if($peminjaman->status != 'Menunggu')
                <div class="alert @if($peminjaman->status == 'Disetujui' || $peminjaman->status == 'Selesai') alert-success @else alert-danger @endif mt-3">
                    <strong>Catatan Admin ({{ $peminjaman->admin->nama ?? 'Sistem' }}):</strong><br>
                    {{ $peminjaman->catatan ?? 'Tidak ada catatan.' }}
                </div>
                @endif
                
                @if($peminjaman->status === 'Selesai' && $peminjaman->pengembalian)
                <div class="card border-primary mt-3">
                    <div class="card-header bg-primary text-white fw-bold">Riwayat Pengembalian</div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <th width="40%">Tanggal Dikembalikan</th>
                                <td>: {{ \Carbon\Carbon::parse($peminjaman->pengembalian->tanggal_kembali)->format('d F Y') }}</td>
                            </tr>
                            @if($peminjaman->jenis === 'aset')
                            <tr>
                                <th>Kondisi Saat Kembali</th>
                                <td>: {{ $peminjaman->pengembalian->kondisi_saat_kembali ?? '-' }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Catatan Admin</th>
                                <td>: {{ $peminjaman->pengembalian->catatan ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection