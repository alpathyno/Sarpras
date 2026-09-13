@extends('layouts.app')
@section('title', 'Laporan Aset - SIM Sarpras')
@section('page_title', 'Laporan Inventaris Aset')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0"><i class="fas fa-boxes me-2"></i> Data Inventaris Aset</h5>
            <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>

        <form action="{{ route('admin.laporan.aset') }}" method="GET" class="p-3 bg-light border rounded mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-bold small">Kondisi Aset</label>
                    <select name="kondisi" class="form-select">
                        <option value="">-- Semua Kondisi --</option>
                        <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small">Status (Ketersediaan)</label>
                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="Tersedia" {{ request('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Diperbaiki" {{ request('status') == 'Diperbaiki' ? 'selected' : '' }}>Diperbaiki</option>
                        <option value="Rusak" {{ request('status') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>
                <div class="col-md-6 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-secondary fw-bold"><i class="fas fa-filter me-1"></i> Filter</button>
                    <button type="submit" name="export" value="pdf" class="btn btn-danger fw-bold"><i class="fas fa-file-pdf me-1"></i> Export PDF</button>
                    <button type="submit" name="export" value="excel" class="btn btn-success fw-bold"><i class="fas fa-file-excel me-1"></i> Export Excel</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle table-sm">
                <thead class="table-dark">
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
                    @forelse($asets as $i => $a)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $a->kode_aset }}</td>
                        <td>{{ $a->nama_aset }}</td>
                        <td>{{ $a->kategoriAset->nama_kategori ?? '-' }}</td>
                        <td>{{ $a->ruangan ? $a->ruangan->nama_ruangan . ' (Gd.' . ($a->ruangan->lantai->gedung->nama_gedung ?? '') . ')' : 'Gudang' }}</td>
                        <td>{{ $a->kondisi }}</td>
                        <td>{{ $a->status }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center">Data tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
