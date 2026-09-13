@extends('layouts.app')
@section('title', 'Data Ruangan - SIM Sarpras')
@section('page_title', 'Data Ruangan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-bold text-success m-0">Daftar Ruangan</h5>
            <a href="{{ route('admin.ruangan.create') }}" class="btn btn-success fw-bold"><i class="fas fa-plus me-1"></i> Tambah Ruangan</a>
        </div>
        <form action="{{ route('admin.ruangan.index') }}" method="GET" class="mb-3">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari kode atau nama ruangan..." value="{{ request('search') }}">
                </div>
                <div class="col-md-5">
                    <select name="lantai_id" class="form-select">
                        <option value="">-- Semua Lantai --</option>
                        @foreach($lantais as $l)
                            <option value="{{ $l->id }}" {{ request('lantai_id') == $l->id ? 'selected' : '' }}>{{ $l->gedung->nama }} - Lantai {{ $l->nomor_lantai }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-success w-100" type="submit"><i class="fas fa-search"></i> Cari/Filter</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Ruangan</th>
                        <th>Lokasi</th>
                        <th>Jenis</th>
                        <th>Kapasitas</th>
                        <th>Dipinjam</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ruangans as $r)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $r->kode_ruangan }}</span></td>
                        <td class="fw-bold">{{ $r->nama_ruangan }}</td>
                        <td>{{ $r->lantai->gedung->nama }} (Lt.{{ $r->lantai->nomor_lantai }})</td>
                        <td>{{ $r->jenis }}</td>
                        <td>{{ $r->kapasitas }} org</td>
                        <td>
                            @if($r->dapat_dipinjam) <span class="badge bg-success">Ya</span>
                            @else <span class="badge bg-danger">Tidak</span> @endif
                        </td>
                        <td>{{ $r->status }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.ruangan.edit', $r->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.ruangan.destroy', $r->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Data ruangan tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $ruangans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
