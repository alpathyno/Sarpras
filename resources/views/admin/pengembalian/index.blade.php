@extends('layouts.app')
@section('title', 'Daftar Pengembalian - SIM Sarpras')
@section('page_title', 'Pengembalian Aset & Ruangan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4"><i class="fas fa-undo-alt me-2"></i> Konfirmasi Pengembalian</h5>
        
        <form action="{{ route('admin.pengembalian.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Aktif (Belum Kembali)</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai (Sudah Kembali)</option>
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
                        <th>Peminjam</th>
                        <th>Jenis</th>
                        <th>Item</th>
                        <th>Jadwal Berakhir</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                    <tr>
                        <td class="fw-bold">{{ $p->user->nama }} <br><span class="badge bg-light text-dark border">{{ ucfirst($p->user->role) }}</span></td>
                        <td><span class="badge bg-secondary">{{ ucfirst($p->jenis) }}</span></td>
                        <td>
                            @foreach($p->details as $d)
                                @if($p->jenis === 'ruangan')
                                    {{ $d->ruangan->nama_ruangan }}
                                @else
                                    {{ $d->aset->nama_aset }} (x{{ $d->jumlah }})
                                @endif
                                <br>
                            @endforeach
                        </td>
                        <td class="{{ \Carbon\Carbon::parse($p->tanggal_selesai)->isPast() && $p->status == 'Disetujui' ? 'text-danger fw-bold' : '' }}">
                            {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            @if($p->status === 'Disetujui') <span class="badge bg-warning text-dark">Sedang Dipinjam</span>
                            @elseif($p->status === 'Selesai') <span class="badge bg-primary">Selesai</span> @endif
                        </td>
                        <td class="text-center">
                            @if($p->status === 'Disetujui')
                                <a href="{{ route('admin.pengembalian.show', $p->id) }}" class="btn btn-sm btn-success fw-bold"><i class="fas fa-check-circle"></i> Konfirmasi</a>
                            @else
                                <a href="{{ route('admin.pengembalian.show', $p->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i> Detail</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada data transaksi aktif.</td>
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