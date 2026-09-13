@extends('layouts.app')
@section('title', 'Modul Laporan - SIM Sarpras')
@section('page_title', 'Cetak Laporan')
@section('content')
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card card-stat bg-white h-100 shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="fas fa-boxes fa-4x text-success mb-3"></i>
                <h4 class="fw-bold">Laporan Master Aset</h4>
                <p class="text-muted">Cetak data inventaris aset, saring berdasarkan kondisi dan ketersediaan saat ini.</p>
                <a href="{{ route('admin.laporan.aset') }}" class="btn btn-success fw-bold px-4">Buka Laporan Aset</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card card-stat bg-white h-100 shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="fas fa-hand-holding fa-4x text-primary mb-3"></i>
                <h4 class="fw-bold">Laporan Peminjaman</h4>
                <p class="text-muted">Rekapitulasi riwayat peminjaman aset dan ruangan berdasarkan rentang waktu tertentu.</p>
                <a href="{{ route('admin.laporan.peminjaman') }}" class="btn btn-primary fw-bold px-4">Buka Laporan Peminjaman</a>
            </div>
        </div>
    </div>
</div>
@endsection
