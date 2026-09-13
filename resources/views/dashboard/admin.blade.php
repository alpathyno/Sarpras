@extends('layouts.app')
@section('title', 'Dashboard Admin - SIM Sarpras')
@section('page_title', 'Dashboard')
@section('content')
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card accent-green p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Total Aset</div>
                    <div class="stat-value">{{ $totalAset }}</div>
                </div>
                <div class="stat-icon icon-green">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
            <div class="stat-footer">
                Baik: {{ $kondisiBaik }} &middot; R.Ringan: {{ $kondisiRusakRingan }} &middot; R.Berat: {{ $kondisiRusakBerat }}
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card accent-blue p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Sedang Dipinjam</div>
                    <div class="stat-value">{{ $asetDipinjam }}</div>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="fas fa-hand-holding"></i>
                </div>
            </div>
            <div class="stat-footer">Item aktif di luar gudang</div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card accent-amber p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Dalam Perbaikan</div>
                    <div class="stat-value">{{ $asetDiperbaiki }}</div>
                </div>
                <div class="stat-icon icon-amber">
                    <i class="fas fa-tools"></i>
                </div>
            </div>
            <div class="stat-footer">Proses pemeliharaan</div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card accent-red p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Belum Diverifikasi</div>
                    <div class="stat-value">{{ $laporanBaru }}</div>
                </div>
                <div class="stat-icon icon-red">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            <div class="stat-footer">Total Laporan Masuk: {{ $totalLaporan }}</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- Chart: Kondisi Aset -->
    <div class="col-md-4 mb-3">
        <div class="card border-0 h-100">
            <div class="card-header"><i class="fas fa-chart-pie me-2 text-green"></i>Kondisi Aset</div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <canvas id="kondisiChart" style="max-height: 230px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart: Status Peminjaman -->
    <div class="col-md-4 mb-3">
        <div class="card border-0 h-100">
            <div class="card-header"><i class="fas fa-chart-bar me-2" style="color: #3b82f6;"></i>Statistik Peminjaman</div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <canvas id="peminjamanChart" style="max-height: 230px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="col-md-4 mb-3">
        <div class="card border-0 h-100">
            <div class="card-header"><i class="fas fa-history me-2" style="color: var(--gray-400);"></i>Peminjaman Terbaru</div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentActivities as $activity)
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0" style="border-bottom: 1px solid var(--gray-100) !important;">
                            <div>
                                <div class="fw-semibold" style="font-size: 0.85rem;">{{ $activity->user->nama }}</div>
                                <small class="text-muted">{{ ucfirst($activity->jenis) }} &middot; {{ \Carbon\Carbon::parse($activity->tanggal_pengajuan)->format('d/m/Y') }}</small>
                            </div>
                            <span class="badge
                                @if($activity->status == 'Menunggu') bg-secondary
                                @elseif($activity->status == 'Disetujui') bg-warning text-dark
                                @elseif($activity->status == 'Selesai') bg-success
                                @else bg-danger @endif">
                                {{ $activity->status }}
                            </span>
                        </div>
                    @empty
                        <div class="list-group-item text-center text-muted border-0 py-4" style="font-size: 0.85rem;">Belum ada aktivitas.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctxKondisi = document.getElementById('kondisiChart').getContext('2d');
    new Chart(ctxKondisi, {
        type: 'doughnut',
        data: {
            labels: ['Baik', 'Rusak Ringan', 'Rusak Berat'],
            datasets: [{
                data: [{{ $kondisiBaik }}, {{ $kondisiRusakRingan }}, {{ $kondisiRusakBerat }}],
                backgroundColor: ['#22c55e', '#f59e0b', '#ef4444'],
                borderWidth: 0,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 16, font: { size: 12, family: 'Poppins' } } }
            }
        }
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
                backgroundColor: ['#9ca3af', '#3b82f6', '#22c55e', '#ef4444'],
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { font: { size: 11, family: 'Poppins' } }, grid: { color: '#f3f4f6' } },
                x: { ticks: { font: { size: 11, family: 'Poppins' } }, grid: { display: false } }
            }
        }
    });
});
</script>
@endsection
