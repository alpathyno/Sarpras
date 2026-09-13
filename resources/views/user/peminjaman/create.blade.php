@extends('layouts.app')
@section('title', 'Form Peminjaman - SIM Sarpras')
@section('page_title', 'Form Peminjaman ' . ucfirst($jenis))
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Pengajuan Peminjaman {{ ucfirst($jenis) }}</h5>
        
        <form action="{{ route('user.peminjaman.store') }}" method="POST">
            @csrf
            <input type="hidden" name="jenis" value="{{ $jenis }}">
            
            @if($jenis === 'ruangan')
                <div class="mb-3">
                    <label for="ruangan_id" class="form-label fw-bold">Pilih Ruangan</label>
                    <select class="form-select @error('ruangan_id') is-invalid @enderror" id="ruangan_id" name="ruangan_id" required>
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach($ruangans as $r)
                            <option value="{{ $r->id }}" {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>{{ $r->nama_ruangan }} (Kapasitas: {{ $r->kapasitas }}) - {{ $r->lantai->gedung->nama }}</option>
                        @endforeach
                    </select>
                    @error('ruangan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            @else
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="aset_id" class="form-label fw-bold">Pilih Aset</label>
                        <select class="form-select @error('aset_id') is-invalid @enderror" id="aset_id" name="aset_id" required>
                            <option value="">-- Pilih Aset --</option>
                            @foreach($asets as $a)
                                <option value="{{ $a->id }}" {{ old('aset_id') == $a->id ? 'selected' : '' }}>{{ $a->nama_aset }} (Tersedia: {{ $a->jumlah }}) - {{ $a->ruangan->nama_ruangan ?? 'Tidak ada lokasi' }}</option>
                            @endforeach
                        </select>
                        @error('aset_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="jumlah" class="form-label fw-bold">Jumlah Dipinjam</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" required min="1">
                        <small class="text-muted">Aset individual maksimal 1</small>
                        @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal_mulai" class="form-label fw-bold">Tanggal & Waktu Mulai</label>
                    <input type="datetime-local" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                    @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal_selesai" class="form-label fw-bold">Tanggal & Waktu Selesai</label>
                    <input type="datetime-local" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                    @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            
            <div class="mb-4">
                <label for="tujuan" class="form-label fw-bold">Tujuan / Kegiatan</label>
                <textarea class="form-control @error('tujuan') is-invalid @enderror" id="tujuan" name="tujuan" rows="3" required>{{ old('tujuan') }}</textarea>
                @error('tujuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle me-1"></i> Permohonan akan diajukan ke Admin untuk mendapatkan persetujuan.
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('user.peminjaman.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-paper-plane me-1"></i> Ajukan Permohonan</button>
            </div>
        </form>
    </div>
</div>
@endsection
