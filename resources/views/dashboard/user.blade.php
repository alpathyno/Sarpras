@extends('layouts.app')
@section('title', 'Dashboard - SIM Sarpras')
@section('page_title', 'Dashboard Personal')
@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-success text-white h-100 shadow-sm border-0">
            <div class="card-body text-center">
                <i class="fas fa-hand-holding fa-2x mb-2"></i>
                <h2 class="mb-0 fw-bold">{{ $totalPeminjaman }}</h2>
                <small>Total Riwayat Peminjaman</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary text-white h-100 shadow-sm border-0">
            <div class="card-body text-center">
                <i class="fas fa-hourglass-half fa-2x mb-2"></i>
                <h2 class="mb-0 fw-bold">{{ $peminjamanPending }}</h2>
                <small>Menunggu Persetujuan</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-primary text-white h-100 shadow-sm border-0">
            <div class="card-body text-center">
                <i class="fas fa-check-circle fa-2x mb-2"></i>
                <h2 class="mb-0 fw-bold">{{ $peminjamanAktif }}</h2>
                <small>Peminjaman Aktif (Disetujui)</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white h-100 shadow-sm border-0">
            <div class="card-body text-center">
                <i class="fas fa-bullhorn fa-2x mb-2"></i>
                <h2 class="mb-0 fw-bold">{{ $totalLaporan }}</h2>
                <small>Laporan Kerusakan Anda</small>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold"><i class="fas fa-history me-2 text-success"></i> Riwayat Peminjaman Terakhir Anda</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPeminjaman as $p)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d/m/Y') }}</td>
                                <td>{{ ucfirst($p->jenis) }}</td>
                                <td>
                                    @if($p->status === 'Menunggu') <span class="badge bg-secondary">Menunggu</span>
                                    @elseif($p->status === 'Disetujui') <span class="badge bg-warning text-dark">Aktif</span>
                                    @elseif($p->status === 'Selesai') <span class="badge bg-success">Selesai</span>
                                    @else <span class="badge bg-danger">Ditolak</span> @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('user.peminjaman.show', $p->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted">Belum ada peminjaman.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white fw-bold"><i class="fas fa-bolt me-2 text-warning"></i> Akses Cepat</div>
            <div class="card-body">
                <a href="{{ route('user.peminjaman.create') }}" class="btn btn-outline-success w-100 mb-3 text-start"><i class="fas fa-plus-circle me-2"></i> Ajukan Peminjaman Baru</a>
                <a href="{{ route('user.laporan_kerusakan.create') }}" class="btn btn-outline-danger w-100 mb-3 text-start"><i class="fas fa-bullhorn me-2"></i> Laporkan Kerusakan Aset</a>
                <a href="{{ route('user.jadwal.index') }}" class="btn btn-outline-primary w-100 text-start"><i class="fas fa-calendar-alt me-2"></i> Lihat Jadwal Ruangan</a>
            </div>
        </div>
    </div>
</div>
@endsection