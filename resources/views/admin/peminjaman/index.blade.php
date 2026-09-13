@extends('layouts.app')
@section('title', 'Approval Peminjaman - SIM Sarpras')
@section('page_title', 'Approval Peminjaman')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Daftar Permohonan Peminjaman</h5>
        
        <form action="{{ route('admin.peminjaman.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="jenis" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Jenis --</option>
                        <option value="ruangan" {{ request('jenis') == 'ruangan' ? 'selected' : '' }}>Ruangan</option>
                        <option value="aset" {{ request('jenis') == 'aset' ? 'selected' : '' }}>Aset</option>
                    </select>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Peminjam</th>
                        <th>Jenis</th>
                        <th>Item Diajukan</th>
                        <th>Jadwal</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                    <tr>
                        <td class="fw-bold">{{ $p->user->nama }} <br><span class="badge bg-light text-dark border">{{ ucfirst($p->user->role) }}</span></td>
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
                            <a href="{{ route('admin.peminjaman.show', $p->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i> Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada permohonan peminjaman.</td>
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
