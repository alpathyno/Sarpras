@extends('layouts.app')
@section('title', 'Data Kategori Aset - SIM Sarpras')
@section('page_title', 'Data Kategori Aset')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-bold text-success m-0">Daftar Kategori Aset</h5>
            <a href="{{ route('admin.kategori_aset.create') }}" class="btn btn-success fw-bold"><i class="fas fa-plus me-1"></i> Tambah Kategori</a>
        </div>
        <form action="{{ route('admin.kategori_aset.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama kategori..." value="{{ request('search') }}">
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i> Cari</button>
            </div>
        </form>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="30%">Nama Kategori</th>
                        <th width="50%">Keterangan</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $index => $k)
                    <tr>
                        <td>{{ $kategoris->firstItem() + $index }}</td>
                        <td class="fw-bold">{{ $k->nama_kategori }}</td>
                        <td>{{ $k->keterangan ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.kategori_aset.edit', $k->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.kategori_aset.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Data kategori aset tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $kategoris->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection