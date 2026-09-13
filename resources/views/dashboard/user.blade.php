@extends('layouts.app')
@section('title', 'Dashboard - SIM Sarpras')
@section('page_title', 'Dashboard')
@section('content')
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card accent-green p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Total Peminjaman</div>
                    <div class="stat-value">{{ $totalPeminjaman }}</div>
                </div>
                <div class="stat-icon icon-green">
                    <i class="fas fa-hand-holding"></i>
                </div>
            </div>
            <div class="stat-footer">Riwayat seluruh peminjaman</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card accent-amber p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Menunggu Persetujuan</div>
                    <div class="stat-value">{{ $peminjamanPending }}</div>
                </div>
                <div class="stat-icon icon-amber">
                    <i class="fas fa-hourglass-half"></i>
                </div>
            </div>
            <div class="stat-footer">Belum diproses admin</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card accent-blue p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Peminjaman Aktif</div>
                    <div class="stat-value">{{ $peminjamanAktif }}</div>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-footer">Disetujui, sedang berjalan</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card accent-red p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Laporan Kerusakan</div>
                    <div class="stat-value">{{ $totalLaporan }}</div>
                </div>
                <div class="stat-icon icon-red">
                    <i class="fas fa-bullhorn"></i>
                </div>
            </div>
            <div class="stat-footer">Total laporan Anda</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card border-0">
            <div class="card-header"><i class="fas fa-history me-2 text-green"></i>Riwayat Peminjaman Terakhir</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
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
                                    <a href="{{ route('user.peminjaman.show', $p->id) }}" class="btn btn-sm btn-outline-success"></i>Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">Belum ada peminjaman.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 h-100">
            <div class="card-header"></i>Akses Cepat</div>
            <div class="card-body d-flex flex-column gap-2">
                <a href="{{ route('user.peminjaman.create') }}" class="btn btn-outline-success text-start">
                    <i class="fas fa-plus-circle me-2"></i>Ajukan Peminjaman Baru
                </a>
                <a href="{{ route('user.laporan_kerusakan.create') }}" class="btn btn-outline-danger text-start">
                    <i class="fas fa-bullhorn me-2"></i>Laporkan Kerusakan Aset
                </a>
                <a href="{{ route('user.jadwal.index') }}" class="btn btn-outline-primary text-start">
                    <i class="fas fa-calendar-alt me-2"></i>Lihat Jadwal Ruangan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
