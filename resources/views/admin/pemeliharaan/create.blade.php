@extends('layouts.app')
@section('title', 'Buat Tiket Pemeliharaan - SIM Sarpras')
@section('page_title', 'Tiket Pemeliharaan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Form Pemeliharaan Aset</h5>
        
        @if($laporan)
            <div class="alert alert-info">
                <strong>Menindaklanjuti Laporan #{{ $laporan->id }}:</strong> {{ $laporan->deskripsi }}
            </div>
        @endif

        <form action="{{ route('admin.pemeliharaan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="laporan_kerusakan_id" value="{{ $laporan->id ?? '' }}">
            
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Aset</label>
                <select name="aset_id" class="form-select @error('aset_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Aset --</option>
                    @foreach($asets as $a)
                        <option value="{{ $a->id }}" {{ (old('aset_id') ?? $aset_id ?? '') == $a->id ? 'selected' : '' }}>{{ $a->kode_aset }} - {{ $a->nama_aset }}</option>
                    @endforeach
                </select>
                @error('aset_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Tanggal Mulai Perbaikan</label>
                <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai', now()->format('Y-m-d')) }}" required>
                @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi Tindakan / Perbaikan</label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Perkiraan Biaya (Opsional)</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="biaya" class="form-control @error('biaya') is-invalid @enderror" value="{{ old('biaya') }}">
                    </div>
                    @error('biaya') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Keterangan Tambahan (Opsional)</label>
                <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan') }}</textarea>
            </div>
            
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-circle me-1"></i> <strong>Perhatian:</strong> Membuat tiket ini akan mengunci aset dari peminjaman (status menjadi 'Diperbaiki').
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pemeliharaan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-save me-1"></i> Simpan Tiket</button>
            </div>
        </form>
    </div>
</div>
@endsection