@extends('layouts.app')
@section('title', 'Jadwal Ruangan - SIM Sarpras')
@section('page_title', 'Jadwal Ruangan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-bold text-success m-0">Daftar Jadwal Ruangan</h5>
            <a href="{{ route('admin.jadwal_ruangan.create') }}" class="btn btn-success fw-bold"><i class="fas fa-plus me-1"></i> Tambah Jadwal</a>
        </div>
        <form action="{{ route('admin.jadwal_ruangan.index') }}" method="GET" class="mb-3">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari kegiatan atau ruangan..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-3">
                    <select name="ruangan_id" class="form-select">
                        <option value="">-- Semua Ruangan --</option>
                        @foreach($ruangans as $r)
                            <option value="{{ $r->id }}" {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>{{ $r->nama_ruangan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-success w-100" type="submit"><i class="fas fa-search"></i> Filter</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Ruangan</th>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $index => $j)
                    <tr>
                        <td>{{ $jadwals->firstItem() + $index }}</td>
                        <td class="fw-bold text-success">{{ $j->ruangan->nama_ruangan }} <br><small class="text-muted">{{ $j->ruangan->lantai->gedung->nama }}</small></td>
                        <td class="fw-bold">{{ $j->kegiatan }}</td>
                        <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</td>
                        <td><span class="badge bg-secondary">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}</span></td>
                        <td>{{ $j->keterangan ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.jadwal_ruangan.edit', $j->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.jadwal_ruangan.destroy', $j->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Data jadwal tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $jadwals->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

