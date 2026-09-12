@extends('layouts.app')
@section('title', 'Peminjaman Saya - SIM Sarpras')
@section('page_title', 'Peminjaman')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0"><i class="fas fa-hand-holding me-2"></i> Riwayat Peminjaman Saya</h5>
            <div>
                <a href="{{ route('user.peminjaman.create', ['jenis' => 'ruangan']) }}" class="btn btn-success fw-bold me-2"><i class="fas fa-door-open me-1"></i> Pinjam Ruangan</a>
                <a href="{{ route('user.peminjaman.create', ['jenis' => 'aset']) }}" class="btn btn-primary fw-bold"><i class="fas fa-box me-1"></i> Pinjam Aset</a>
            </div>
        </div>
        
        <form action="{{ route('user.peminjaman.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tgl Pengajuan</th>
                        <th>Jenis</th>
                        <th>Item yang Dipinjam</th>
                        <th>Jadwal Peminjaman</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d/m/Y') }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($p->jenis) }}</span></td>
                        <td class="fw-bold">
                            @foreach($p->details as $d)
                                @if($p->jenis === 'ruangan')
                                    {{ $d->ruangan->nama_ruangan }}
                                @else
                                    {{ $d->aset->nama_aset }} (x{{ $d->jumlah }})
                                @endif
                                <br>
                            @endforeach
                        </td>
                        <td>
                            <small>
                            Mul: {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d/m/Y H:i') }}<br>
                            Sel: {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d/m/Y H:i') }}
                            </small>
                        </td>
                        <td>{{ Str::limit($p->tujuan, 30) }}</td>
                        <td>
                            @if($p->status === 'Menunggu') <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($p->status === 'Disetujui') <span class="badge bg-success">Disetujui</span>
                            @elseif($p->status === 'Selesai') <span class="badge bg-primary">Selesai</span>
                            @else <span class="badge bg-danger">Ditolak</span> @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('user.peminjaman.show', $p->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i> Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada riwayat peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $peminjamans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection