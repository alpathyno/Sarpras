@extends('layouts.app')
@section('title', 'Laporan Peminjaman - SIM Sarpras')
@section('page_title', 'Laporan Peminjaman')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-primary m-0"><i class="fas fa-hand-holding me-2"></i> Rekapitulasi Peminjaman</h5>
            <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>

        <form action="{{ route('admin.laporan.peminjaman') }}" method="GET" class="p-3 bg-light border rounded mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-2">
                    <label class="form-label fw-bold small">Status</label>
                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui (Aktif)</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small">Dari Tanggal (Pengajuan)</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-4 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-secondary fw-bold"><i class="fas fa-filter me-1"></i> Filter</button>
                    <button type="submit" name="export" value="pdf" class="btn btn-danger fw-bold"><i class="fas fa-file-pdf me-1"></i> PDF</button>
                    <button type="submit" name="export" value="excel" class="btn btn-success fw-bold"><i class="fas fa-file-excel me-1"></i> Excel</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Tgl Pengajuan</th>
                        <th>Peminjam</th>
                        <th>Jenis</th>
                        <th>Item</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                    <tr>
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
                    @empty
                    <tr><td colspan="5" class="text-center">Data tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
