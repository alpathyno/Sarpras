@extends('layouts.app')
@section('title', 'Tambah Jadwal Ruangan - SIM Sarpras')
@section('page_title', 'Tambah Jadwal')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Form Tambah Jadwal</h5>
        <form action="{{ route('admin.jadwal_ruangan.store') }}" method="POST">
            @csrf
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
            <div class="mb-3">
                <label for="kegiatan" class="form-label fw-bold">Kegiatan</label>
                <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan" name="kegiatan" value="{{ old('kegiatan') }}" required>
                @error('kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                    @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="jam_mulai" class="form-label fw-bold">Jam Mulai</label>
                    <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                    @error('jam_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="jam_selesai" class="form-label fw-bold">Jam Selesai</label>
                    <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                    @error('jam_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mb-4">
                <label for="keterangan" class="form-label fw-bold">Keterangan (Opsional)</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.jadwal_ruangan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-save me-1"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

