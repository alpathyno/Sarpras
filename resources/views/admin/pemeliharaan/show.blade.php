@extends('layouts.app')
@section('title', 'Detail Pemeliharaan - SIM Sarpras')
@section('page_title', 'Detail Tiket Pemeliharaan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0">Detail Tiket #{{ $pemeliharaan->id }}</h5>
            <a href="{{ route('admin.pemeliharaan.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        
        <table class="table table-bordered">
            <tr><th width="30%">Aset</th><td>{{ $pemeliharaan->aset->nama_aset }}</td></tr>
            <tr><th>Deskripsi Pekerjaan</th><td>{{ $pemeliharaan->deskripsi }}</td></tr>
            <tr><th>Status</th><td>{{ $pemeliharaan->status }}</td></tr>
            <tr><th>Tanggal Mulai</th><td>{{ $pemeliharaan->tanggal_mulai }}</td></tr>
            <tr><th>Tanggal Selesai</th><td>{{ $pemeliharaan->tanggal_selesai ?? '-' }}</td></tr>
            <tr><th>Biaya</th><td>Rp {{ number_format($pemeliharaan->biaya, 0, ',', '.') }}</td></tr>
            <tr><th>Keterangan</th><td>{{ $pemeliharaan->keterangan ?? '-' }}</td></tr>
            @if($pemeliharaan->laporanKerusakan)
            <tr><th>Berdasarkan Laporan</th><td>Oleh: {{ $pemeliharaan->laporanKerusakan->user->nama }} pada {{ $pemeliharaan->laporanKerusakan->tanggal_laporan }}</td></tr>
            @endif
        </table>
        
        <div class="mt-3">
            <a href="{{ route('admin.pemeliharaan.edit', $pemeliharaan->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Update Status Pekerjaan</a>
        </div>
    </div>
</div>
@endsection
