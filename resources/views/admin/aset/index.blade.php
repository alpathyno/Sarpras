@extends('layouts.app')
@section('title', 'Data Aset - SIM Sarpras')
@section('page_title', 'Data Aset')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-bold text-success m-0">Daftar Aset</h5>
            <a href="{{ route('admin.aset.create') }}" class="btn btn-success fw-bold"><i class="fas fa-plus me-1"></i> Tambah Aset</a>
        </div>
        <form action="{{ route('admin.aset.index') }}" method="GET" class="mb-3">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari kode atau nama aset..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="kategori_id" class="form-select">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="ruangan_id" class="form-select">
                        <option value="">-- Semua Lokasi --</option>
                        @foreach($ruangans as $r)
                            <option value="{{ $r->id }}" {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>{{ $r->nama_ruangan }} ({{ $r->kode_ruangan }})</option>
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
                        <th>Foto</th>
                        <th>Aset</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Jml</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($asets as $a)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $a->kode_aset }}</span></td>
                        <td>
                            @if($a->foto)
                                <img src="{{ asset('storage/' . $a->foto) }}" alt="Foto Aset" class="img-thumbnail" style="max-height: 50px;">
                            @else
                                <span class="text-muted small">No Image</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $a->nama_aset }}</td>
                        <td>{{ $a->kategoriAset->nama_kategori ?? '-' }}</td>
                        <td>{{ $a->ruangan ? $a->ruangan->nama_ruangan : 'Tidak ada lokasi' }}</td>
                        <td>{{ $a->jumlah }}</td>
                        <td>
                            @if($a->kondisi === 'Baik') <span class="badge bg-success">Baik</span>
                            @elseif($a->kondisi === 'Rusak Ringan') <span class="badge bg-warning text-dark">Rusak Ringan</span>
                            @else <span class="badge bg-danger">Rusak Berat</span> @endif
                        </td>
                        <td>{{ $a->status }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.aset.edit', $a->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.aset.destroy', $a->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Data aset tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $asets->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
