@extends('layouts.app')
@section('title', 'Detail Laporan - SIM Sarpras')
@section('page_title', 'Detail Laporan Kerusakan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0">Detail Laporan #{{ $laporan->id }}</h5>
            <a href="{{ route('user.laporan_kerusakan.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        
        <div class="row">
            <div class="col-md-7">
                <table class="table table-bordered">
                    <tr>
                        <th width="35%" class="bg-light">Tgl Laporan</th>
                        <td>{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Status Saat Ini</th>
                        <td>
                            @if($laporan->status === 'Dilaporkan') <span class="badge bg-secondary">Dilaporkan</span>
                            @elseif($laporan->status === 'Dalam Perbaikan') <span class="badge bg-warning text-dark">Dalam Perbaikan</span>
                            @elseif($laporan->status === 'Selesai') <span class="badge bg-success">Selesai</span>
                            @else <span class="badge bg-danger">{{ $laporan->status }}</span> @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Aset Dilaporkan</th>
                        <td>
                            <strong>{{ $laporan->aset->nama_aset }}</strong> ({{ $laporan->aset->kode_aset }})<br>
                            Lokasi: {{ $laporan->aset->ruangan->nama_ruangan ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Deskripsi Kerusakan</th>
                        <td>{{ $laporan->deskripsi }}</td>
                    </tr>
                </table>
                
                @if($laporan->status != 'Dilaporkan')
                <div class="alert alert-info mt-3">
                    <strong>Catatan Penanganan Admin:</strong><br>
                    {{ $laporan->catatan_admin ?? 'Sedang diproses.' }}
                </div>
                @endif
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-danger text-white fw-bold">Foto Bukti Kerusakan</div>
                    <div class="card-body text-center bg-light">
                        @if($laporan->foto)
                            <img src="{{ Storage::url($laporan->foto) }}" alt="Foto Kerusakan" class="img-fluid rounded" style="max-height: 300px; object-fit: contain;">
                        @else
                            <div class="text-muted py-4"><i class="fas fa-image fs-1 mb-2 d-block"></i>Tidak ada foto</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
