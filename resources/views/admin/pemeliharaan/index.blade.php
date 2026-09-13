@extends('layouts.app')
@section('title', 'Pemeliharaan Aset - SIM Sarpras')
@section('page_title', 'Pemeliharaan Aset')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0"><i class="fas fa-tools me-2"></i> Jadwal Pemeliharaan</h5>
            <a href="{{ route('admin.pemeliharaan.create') }}" class="btn btn-success fw-bold"><i class="fas fa-plus me-1"></i> Buat Tiket Baru</a>
        </div>

        <form action="{{ route('admin.pemeliharaan.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        <option value="Direncanakan" {{ request('status') == 'Direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                        <option value="Sedang Berjalan" {{ request('status') == 'Sedang Berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Aset</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemeliharaans as $p)
                    <tr>
                        <td class="fw-bold">{{ $p->aset->nama_aset }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td>{{ $p->tanggal_selesai ? \Carbon\Carbon::parse($p->tanggal_selesai)->format('d/m/Y') : '-' }}</td>
                        <td>{{ Str::limit($p->deskripsi, 30) }}</td>
                        <td>
                            @if($p->status === 'Direncanakan') <span class="badge bg-secondary">Direncanakan</span>
                            @elseif($p->status === 'Sedang Berjalan') <span class="badge bg-warning text-dark">Sedang Berjalan</span>
                            @elseif($p->status === 'Selesai') <span class="badge bg-success">Selesai</span> @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.pemeliharaan.edit', $p->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Update</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data pemeliharaan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $pemeliharaans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
