@extends('layouts.app')
@section('title', 'Data Lantai - SIM Sarpras')
@section('page_title', 'Data Lantai')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-bold text-success m-0">Daftar Lantai</h5>
            <a href="{{ route('admin.lantai.create') }}" class="btn btn-success fw-bold"><i class="fas fa-plus me-1"></i> Tambah Lantai</a>
        </div>
        <form action="{{ route('admin.lantai.index') }}" method="GET" class="mb-3">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari nomor lantai atau gedung..." value="{{ request('search') }}">
                </div>
                <div class="col-md-5">
                    <select name="gedung_id" class="form-select">
                        <option value="">-- Semua Gedung --</option>
                        @foreach($gedungs as $g)
                            <option value="{{ $g->id }}" {{ request('gedung_id') == $g->id ? 'selected' : '' }}>{{ $g->nama }} ({{ $g->kode }})</option>
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
                        <th width="5%">No</th>
                        <th width="20%">Gedung</th>
                        <th width="15%">Nomor Lantai</th>
                        <th width="45%">Keterangan</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lantais as $index => $l)
                    <tr>
                        <td>{{ $lantais->firstItem() + $index }}</td>
                        <td class="fw-bold">{{ $l->gedung->nama }}</td>
                        <td><span class="badge bg-secondary">Lantai {{ $l->nomor_lantai }}</span></td>
                        <td>{{ $l->keterangan ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.lantai.edit', $l->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.lantai.destroy', $l->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Data lantai tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $lantais->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
