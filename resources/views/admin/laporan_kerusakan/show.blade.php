@extends('layouts.app')
@section('title', 'Detail Laporan - SIM Sarpras')
@section('page_title', 'Tinjau Laporan Kerusakan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0">Tinjau Laporan #{{ $laporan->id }}</h5>
            <a href="{{ route('admin.laporan_kerusakan.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="35%" class="bg-light">Pelapor</th>
                        <td>{{ $laporan->user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Tgl Laporan</th>
                        <td>{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Status Saat Ini</th>
                        <td>
                            @if($laporan->status === 'Dilaporkan') <span class="badge bg-danger">Dilaporkan</span>
                            @elseif($laporan->status === 'Diverifikasi') <span class="badge bg-info text-dark">Diverifikasi</span>
                            @elseif($laporan->status === 'Dalam Perbaikan') <span class="badge bg-warning text-dark">Dalam Perbaikan</span>
                            @elseif($laporan->status === 'Selesai') <span class="badge bg-success">Selesai</span>
                            @else <span class="badge bg-secondary">{{ $laporan->status }}</span> @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Aset Dilaporkan</th>
                        <td>
                            <strong>{{ $laporan->aset->nama_aset }}</strong> ({{ $laporan->aset->kode_aset }})<br>
                            Lokasi: {{ $laporan->aset->ruangan->nama_ruangan ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Deskripsi Kerusakan</th>
                        <td>{{ $laporan->deskripsi }}</td>
                    </tr>
                </table>

                @if($laporan->status === 'Diverifikasi')
                <div class="alert alert-warning">
                    Laporan telah diverifikasi. Anda dapat membuat jadwal perbaikan dengan menekan tombol di bawah.
                    <br><br>
                    <a href="{{ route('admin.pemeliharaan.create', ['laporan_id' => $laporan->id, 'aset_id' => $laporan->aset_id]) }}" class="btn btn-sm btn-dark"><i class="fas fa-tools me-1"></i> Buat Tiket Pemeliharaan</a>
                </div>
                @endif
                
                <div class="card border-primary mt-4">
                    <div class="card-header bg-primary text-white fw-bold">Update Status Penanganan</div>
                    <div class="card-body bg-light">
                        <form action="{{ route('admin.laporan_kerusakan.update', $laporan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pilih Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="Dilaporkan" {{ $laporan->status == 'Dilaporkan' ? 'selected' : '' }}>Dilaporkan</option>
                                    <option value="Diverifikasi" {{ $laporan->status == 'Diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                    <option value="Dalam Perbaikan" {{ $laporan->status == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                                    <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Catatan Admin</label>
                                <textarea name="catatan_admin" class="form-control" rows="3">{{ $laporan->catatan_admin }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary fw-bold w-100"><i class="fas fa-save me-1"></i> Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white fw-bold">Foto Bukti Kerusakan</div>
                    <div class="card-body text-center bg-light">
                        @if($laporan->foto)
                            <img src="{{ Storage::url($laporan->foto) }}" alt="Foto Kerusakan" class="img-fluid rounded" style="max-height: 400px; object-fit: contain;">
                        @else
                            <div class="text-muted py-4"><i class="fas fa-image fs-1 mb-2 d-block"></i>Tidak ada foto</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
