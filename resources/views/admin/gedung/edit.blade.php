@extends('layouts.app')
@section('title', 'Edit Gedung - SIM Sarpras')
@section('page_title', 'Edit Gedung')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Form Edit Gedung</h5>
        <form action="{{ route('admin.gedung.update', $gedung->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="kode" class="form-label fw-bold">Kode Gedung</label>
                <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode', $gedung->kode) }}" required>
                @error('kode') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label fw-bold">Nama Gedung</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $gedung->nama) }}" required>
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label for="keterangan" class="form-label fw-bold">Keterangan (Opsional)</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $gedung->keterangan) }}</textarea>
                @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.gedung.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
