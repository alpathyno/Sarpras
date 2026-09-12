@extends('layouts.app')
@section('title', 'Detail Perpindahan - SIM Sarpras')
@section('page_title', 'Detail Riwayat Perpindahan Aset')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0">Detail Pindah Aset #{{ $perpindahan->id }}</h5>
            <a href="{{ route('admin.perpindahan_aset.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        
        <table class="table table-bordered">
            <tr><th width="30%" class="bg-light">Aset</th><td><strong>{{ $perpindahan->aset->nama_aset }}</strong> ({{ $perpindahan->aset->kode_aset }})</td></tr>
            <tr><th class="bg-light">Tanggal Pindah</th><td>{{ \Carbon\Carbon::parse($perpindahan->tanggal)->format('d F Y') }}</td></tr>
            <tr><th class="bg-light">Lokasi Asal</th><td><span class="text-danger"><i class="fas fa-sign-out-alt me-1"></i> {{ $perpindahan->ruanganAsal->nama_ruangan ?? 'Tidak Diketahui' }}</span></td></tr>
            <tr><th class="bg-light">Lokasi Tujuan</th><td><span class="text-success fw-bold"><i class="fas fa-sign-in-alt me-1"></i> {{ $perpindahan->ruanganTujuan->nama_ruangan ?? 'Tidak Diketahui' }}</span></td></tr>
            <tr><th class="bg-light">Admin Penanggung Jawab</th><td>{{ $perpindahan->user->nama ?? '-' }}</td></tr>
            <tr><th class="bg-light">Alasan</th><td>{{ $perpindahan->alasan }}</td></tr>
            <tr><th class="bg-light">Keterangan Tambahan</th><td>{{ $perpindahan->keterangan ?? '-' }}</td></tr>
        </table>
        
    </div>
</div>
@endsection