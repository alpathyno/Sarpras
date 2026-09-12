@extends('layouts.app')
@section('title', 'Perpindahan Aset - SIM Sarpras')
@section('page_title', 'Riwayat Perpindahan Aset')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0"><i class="fas fa-exchange-alt me-2"></i> Log Perpindahan Aset</h5>
            <a href="{{ route('admin.perpindahan_aset.create') }}" class="btn btn-success fw-bold"><i class="fas fa-plus-circle me-1"></i> Catat Perpindahan Baru</a>
        </div>

        <form action="{{ route('admin.perpindahan_aset.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari kode atau nama aset..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-search me-1"></i> Cari</button>
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
                        <th>Tgl Pindah</th>
                        <th>Aset</th>
                        <th>Dari (Asal)</th>
                        <th>Ke (Tujuan)</th>
                        <th>Alasan</th>
                        <th class="text-center">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($perpindahans as $p)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                        <td class="fw-bold">{{ $p->aset->nama_aset }}<br><small class="text-muted">{{ $p->aset->kode_aset }}</small></td>
                        <td>{{ $p->ruanganAsal ? $p->ruanganAsal->nama_ruangan : 'Tidak Diketahui' }}</td>
                        <td class="fw-bold text-success">{{ $p->ruanganTujuan ? $p->ruanganTujuan->nama_ruangan : 'Tidak Diketahui' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($p->alasan, 30) }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.perpindahan_aset.show', $p->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada riwayat perpindahan aset.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $perpindahans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection