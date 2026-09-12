@extends('layouts.app')
@section('title', 'Tambah Ruangan - SIM Sarpras')
@section('page_title', 'Tambah Ruangan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Form Tambah Ruangan</h5>
        <form action="{{ route('admin.ruangan.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="lantai_id" class="form-label fw-bold">Lokasi Lantai & Gedung</label>
                    <select class="form-select @error('lantai_id') is-invalid @enderror" id="lantai_id" name="lantai_id" required>
                        <option value="">-- Pilih Lokasi --</option>
                        @foreach($lantais as $l)
                            <option value="{{ $l->id }}" {{ old('lantai_id') == $l->id ? 'selected' : '' }}>{{ $l->gedung->nama }} - Lantai {{ $l->nomor_lantai }}</option>
                        @endforeach
                    </select>
                    @error('lantai_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="kode_ruangan" class="form-label fw-bold">Kode Ruangan</label>
                    <input type="text" class="form-control @error('kode_ruangan') is-invalid @enderror" id="kode_ruangan" name="kode_ruangan" value="{{ old('kode_ruangan') }}" required>
                    @error('kode_ruangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_ruangan" class="form-label fw-bold">Nama Ruangan</label>
                    <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror" id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan') }}" required>
                    @error('nama_ruangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jenis" class="form-label fw-bold">Jenis Ruangan</label>
                    <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" value="{{ old('jenis', 'Ruang Lainnya') }}" required>
                    @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="kapasitas" class="form-label fw-bold">Kapasitas</label>
                    <input type="number" class="form-control @error('kapasitas') is-invalid @enderror" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', 0) }}" required min="0">
                    @error('kapasitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="dapat_dipinjam" class="form-label fw-bold">Dapat Dipinjam?</label>
                    <select class="form-select @error('dapat_dipinjam') is-invalid @enderror" id="dapat_dipinjam" name="dapat_dipinjam" required>
                        <option value="1" {{ old('dapat_dipinjam') == '1' ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ old('dapat_dipinjam', '0') == '0' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('dapat_dipinjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-4">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="Tersedia" {{ old('status', 'Tersedia') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Dalam Perbaikan" {{ old('status') == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                        <option value="Tidak Digunakan" {{ old('status') == 'Tidak Digunakan' ? 'selected' : '' }}>Tidak Digunakan</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.ruangan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-save me-1"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection