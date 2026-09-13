@extends('layouts.app')
@section('title', 'Laporan Kerusakan - SIM Sarpras')
@section('page_title', 'Kelola Laporan Kerusakan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-danger mb-4"><i class="fas fa-exclamation-triangle me-2"></i> Daftar Laporan Masuk</h5>
        
        <form action="{{ route('admin.laporan_kerusakan.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        <option value="Dilaporkan" {{ request('status') == 'Dilaporkan' ? 'selected' : '' }}>Dilaporkan (Baru)</option>
                        <option value="Diverifikasi" {{ request('status') == 'Diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                        <option value="Dalam Perbaikan" {{ request('status') == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Pelapor</th>
                        <th>Aset</th>
                        <th>Lokasi</th>
                        <th>Tgl Lapor</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $l)
                    <tr>
                        <td class="fw-bold">{{ $l->user->nama }}</td>
                        <td class="fw-bold text-success">{{ $l->aset->nama_aset }}</td>
                        <td>{{ $l->aset->ruangan->nama_ruangan ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($l->tanggal_laporan)->format('d/m/Y') }}</td>
                        <td>
                            @if($l->status === 'Dilaporkan') <span class="badge bg-danger">Dilaporkan</span>
                            @elseif($l->status === 'Diverifikasi') <span class="badge bg-info text-dark">Diverifikasi</span>
                            @elseif($l->status === 'Dalam Perbaikan') <span class="badge bg-warning text-dark">Dalam Perbaikan</span>
                            @elseif($l->status === 'Selesai') <span class="badge bg-success">Selesai</span>
                            @else <span class="badge bg-secondary">{{ $l->status }}</span> @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.laporan_kerusakan.show', $l->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Verifikasi</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada laporan kerusakan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $laporans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
