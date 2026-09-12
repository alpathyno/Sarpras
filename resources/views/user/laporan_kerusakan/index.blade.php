@extends('layouts.app')
@section('title', 'Laporan Kerusakan Saya - SIM Sarpras')
@section('page_title', 'Laporan Kerusakan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0"><i class="fas fa-bullhorn me-2"></i> Laporan Kerusakan Saya</h5>
            <a href="{{ route('user.laporan_kerusakan.create') }}" class="btn btn-danger fw-bold"><i class="fas fa-plus-circle me-1"></i> Buat Laporan Baru</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal Lapor</th>
                        <th>Aset</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $l)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($l->tanggal_laporan)->format('d/m/Y') }}</td>
                        <td class="fw-bold text-success">{{ $l->aset->nama_aset }}</td>
                        <td>{{ $l->aset->ruangan->nama_ruangan ?? 'Tidak diketahui' }}</td>
                        <td>{{ Str::limit($l->deskripsi, 30) }}</td>
                        <td>
                            @if($l->status === 'Dilaporkan') <span class="badge bg-secondary">Dilaporkan</span>
                            @elseif($l->status === 'Dalam Perbaikan') <span class="badge bg-warning text-dark">Dalam Perbaikan</span>
                            @elseif($l->status === 'Selesai') <span class="badge bg-success">Selesai</span>
                            @else <span class="badge bg-danger">{{ $l->status }}</span> @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('user.laporan_kerusakan.show', $l->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada riwayat laporan kerusakan.</td>
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