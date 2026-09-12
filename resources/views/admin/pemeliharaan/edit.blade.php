@extends('layouts.app')
@section('title', 'Update Pemeliharaan - SIM Sarpras')
@section('page_title', 'Update Pemeliharaan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Update Status Pemeliharaan</h5>
        
        <div class="mb-4 p-3 bg-light border rounded">
            <strong>Aset:</strong> {{ $pemeliharaan->aset->nama_aset }}<br>
            <strong>Deskripsi Pekerjaan:</strong> {{ $pemeliharaan->deskripsi }}
        </div>

        <form action="{{ route('admin.pemeliharaan.update', $pemeliharaan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-bold">Status Pekerjaan</label>
                <select name="status" id="status-select" class="form-select" required>
                    <option value="Direncanakan" {{ $pemeliharaan->status == 'Direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                    <option value="Sedang Berjalan" {{ $pemeliharaan->status == 'Sedang Berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                    <option value="Selesai" {{ $pemeliharaan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div id="selesai-fields" style="display: {{ $pemeliharaan->status == 'Selesai' ? 'block' : 'none' }};">
                <div class="mb-3">
                    <label class="form-label fw-bold">Tanggal Selesai Aktual</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ $pemeliharaan->tanggal_selesai ?? now()->format('Y-m-d') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold text-danger">Kondisi Aset Pasca Perbaikan (PENTING)</label>
                    <select name="kondisi_aset_final" class="form-select">
                        <option value="Baik" {{ $pemeliharaan->aset->kondisi == 'Baik' ? 'selected' : '' }}>Baik (Bisa Dipinjam)</option>
                        <option value="Rusak Ringan" {{ $pemeliharaan->aset->kondisi == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan (Bisa Dipinjam)</option>
                        <option value="Rusak Berat" {{ $pemeliharaan->aset->kondisi == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat / Afkir (TIDAK Bisa Dipinjam)</option>
                    </select>
                    <small class="text-muted">Ini akan menentukan apakah aset akan dibuka kembali untuk peminjaman publik.</small>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Total Biaya (Opsional)</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="biaya" class="form-control" value="{{ (int)$pemeliharaan->biaya }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Keterangan / Laporan Hasil</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ $pemeliharaan->keterangan }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pemeliharaan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary fw-bold"><i class="fas fa-save me-1"></i> Update Status</button>
            </div>
        </form>
    </div>
</div>
<script>
document.getElementById('status-select').addEventListener('change', function() {
    if(this.value === 'Selesai') {
        document.getElementById('selesai-fields').style.display = 'block';
    } else {
        document.getElementById('selesai-fields').style.display = 'none';
    }
});
</script>
@endsection