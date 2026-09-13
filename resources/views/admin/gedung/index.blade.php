@extends('layouts.app')
@section('title', 'Data Gedung - SIM Sarpras')
@section('page_title', 'Data Gedung')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-bold text-success m-0">Daftar Gedung</h5>
            <a href="{{ route('admin.gedung.create') }}" class="btn btn-success fw-bold"><i class="fas fa-plus me-1"></i> Tambah Gedung</a>
        </div>
        <form action="{{ route('admin.gedung.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari kode atau nama gedung..." value="{{ request('search') }}">
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i> Cari</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Kode</th>
                        <th width="30%">Nama Gedung</th>
                        <th width="35%">Keterangan</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gedungs as $index => $g)
                    <tr>
                        <td>{{ $gedungs->firstItem() + $index }}</td>
                        <td><span class="badge bg-secondary">{{ $g->kode }}</span></td>
                        <td class="fw-bold">{{ $g->nama }}</td>
                        <td>{{ $g->keterangan ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.gedung.edit', $g->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.gedung.destroy', $g->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Data gedung tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $gedungs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
