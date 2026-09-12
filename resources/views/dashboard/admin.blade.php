@extends('layouts.app')
@section('title', 'Dashboard Admin - SIM Sarpras')
@section('page_title', 'Dashboard Statistik')
@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-success text-white h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1" style="font-size: 0.8rem;">Total Aset</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalAset }}</h2>
                    </div>
                    <i class="fas fa-boxes fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-success border-0 d-flex justify-content-between" style="filter: brightness(0.9);">
                <small>Baik: {{ $kondisiBaik }} | R.Ringan: {{ $kondisiRusakRingan }}</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-primary text-white h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1" style="font-size: 0.8rem;">Sedang Dipinjam</h6>
                        <h2 class="mb-0 fw-bold">{{ $asetDipinjam }}</h2>
                    </div>
                    <i class="fas fa-hand-holding fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-primary border-0" style="filter: brightness(0.9);">
                <small>Item aktif diluar gudang</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-dark h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1" style="font-size: 0.8rem;">Dalam Perbaikan</h6>
                        <h2 class="mb-0 fw-bold">{{ $asetDiperbaiki }}</h2>
                    </div>
                    <i class="fas fa-tools fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-warning border-0 text-dark" style="filter: brightness(0.9);">
                <small>Proses pemeliharaan</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-danger text-white h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1" style="font-size: 0.8rem;">Laporan Kerusakan</h6>
                        <h2 class="mb-0 fw-bold">{{ $laporanBaru }}</h2>
                    </div>
                    <i class="fas fa-exclamation-triangle fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-danger border-0" style="filter: brightness(0.9);">
                <small>Belum diverifikasi (Total: {{ $totalLaporan }})</small>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart: Kondisi Aset -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white fw-bold"><i class="fas fa-chart-pie me-2 text-success"></i> Kondisi Aset</div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <canvas id="kondisiChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart: Status Peminjaman -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white fw-bold"><i class="fas fa-chart-bar me-2 text-primary"></i> Statistik Peminjaman</div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <canvas id="peminjamanChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white fw-bold"><i class="fas fa-history me-2 text-secondary"></i> Peminjaman Terbaru</div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($recentActivities as $activity)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">{{ $activity->user->nama }}</div>
                                <small class="text-muted">{{ ucfirst($activity->jenis) }} - {{ \Carbon\Carbon::parse($activity->tanggal_pengajuan)->format('d/m/Y') }}</small>
                            </div>
                            <span class="badge 
                                @if($activity->status == 'Menunggu') bg-secondary 
                                @elseif($activity->status == 'Disetujui') bg-warning text-dark
                                @elseif($activity->status == 'Selesai') bg-success
                                @else bg-danger @endif">
                                {{ $activity->status }}
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">Belum ada aktivitas.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctxKondisi = document.getElementById('kondisiChart').getContext('2d');
    new Chart(ctxKondisi, {
        type: 'pie',
        data: {
            labels: ['Baik', 'Rusak Ringan', 'Rusak Berat'],
            datasets: [{
                data: [{{ $kondisiBaik }}, {{ $kondisiRusakRingan }}, {{ $kondisiRusakBerat }}],
                backgroundColor: ['#198754', '#ffc107', '#dc3545'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    const ctxPeminjaman = document.getElementById('peminjamanChart').getContext('2d');
    new Chart(ctxPeminjaman, {
        type: 'bar',
        data: {
            labels: ['Pending', 'Aktif', 'Selesai', 'Ditolak'],
            datasets: [{
                label: 'Jumlah',
                data: [
                    {{ $peminjamanStats['Pending'] }}, 
                    {{ $peminjamanStats['Aktif'] }}, 
                    {{ $peminjamanStats['Selesai'] }}, 
                    {{ $peminjamanStats['Ditolak'] }}
                ],
                backgroundColor: ['#6c757d', '#0d6efd', '#198754', '#dc3545']
            }]
        },
        options: { 
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });
});
</script>
@endsection