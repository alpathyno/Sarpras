@extends('layouts.app')
@section('title', 'Konfirmasi Pengembalian - SIM Sarpras')
@section('page_title', 'Proses Pengembalian')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0">Detail Peminjaman #{{ $peminjaman->id }}</h5>
            <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="35%" class="bg-light">Peminjam</th>
                        <td>{{ $peminjaman->user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Status Saat Ini</th>
                        <td>
                            @if($peminjaman->status === 'Disetujui') <span class="badge bg-warning text-dark">Sedang Dipinjam</span>
                            @elseif($peminjaman->status === 'Selesai') <span class="badge bg-primary">Selesai</span> @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Tenggat Waktu</th>
                        <td class="{{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->isPast() && $peminjaman->status == 'Disetujui' ? 'text-danger fw-bold' : '' }}">
                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d F Y H:i') }}
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Item ({{ ucfirst($peminjaman->jenis) }})</th>
                        <td>
                            <ul class="mb-0 ps-3">
                            @foreach($peminjaman->details as $d)
                                <li>
                                    @if($peminjaman->jenis === 'ruangan')
                                        {{ $d->ruangan->nama_ruangan }}
                                    @else
                                        {{ $d->aset->nama_aset }} (x{{ $d->jumlah }})
                                    @endif
                                </li>
                            @endforeach
                            </ul>
                        </td>
                    </tr>
                </table>
                
                @if($peminjaman->status === 'Selesai' && $peminjaman->pengembalian)
                <div class="card border-primary mt-4">
                    <div class="card-header bg-primary text-white fw-bold">Riwayat Pengembalian</div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <th width="40%">Tanggal Dikembalikan</th>
                                <td>: {{ \Carbon\Carbon::parse($peminjaman->pengembalian->tanggal_kembali)->format('d F Y') }}</td>
                            </tr>
                            @if($peminjaman->jenis === 'aset')
                            <tr>
                                <th>Kondisi Saat Kembali</th>
                                <td>: {{ $peminjaman->pengembalian->kondisi_saat_kembali ?? '-' }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Catatan Admin</th>
                                <td>: {{ $peminjaman->pengembalian->catatan ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="col-md-6">
                @if($peminjaman->status === 'Disetujui')
                <div class="card border-success">
                    <div class="card-header bg-success text-white fw-bold">Form Konfirmasi Pengembalian</div>
                    <div class="card-body bg-light">
                        <form action="{{ route('admin.pengembalian.process', $peminjaman->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Dikembalikan</label>
                                <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" name="tanggal_kembali" value="{{ now()->format('Y-m-d') }}" required>
                                @error('tanggal_kembali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            @if($peminjaman->jenis === 'aset')
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kondisi Aset Saat Kembali</label>
                                <select name="kondisi_saat_kembali" class="form-select @error('kondisi_saat_kembali') is-invalid @enderror" required>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                                <small class="text-muted">Jika aset rusak, status ketersediaan master aset akan ikut diperbarui.</small>
                            </div>
                            @endif
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Catatan (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="3" placeholder="Keterangan tambahan saat pengembalian..."></textarea>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success fw-bold" onclick="return confirm('Apakah Anda yakin barang/ruangan ini telah selesai digunakan/dikembalikan? Proses ini tidak dapat dibatalkan.')">
                                    <i class="fas fa-check-circle me-1"></i> Konfirmasi Selesai
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection