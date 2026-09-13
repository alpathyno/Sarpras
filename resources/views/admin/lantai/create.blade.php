@extends('layouts.app')
@section('title', 'Tambah Lantai - SIM Sarpras')
@section('page_title', 'Tambah Lantai')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Form Tambah Lantai</h5>
        <form action="{{ route('admin.lantai.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="gedung_id" class="form-label fw-bold">Gedung</label>
                <select class="form-select @error('gedung_id') is-invalid @enderror" id="gedung_id" name="gedung_id" required>
                    <option value="">-- Pilih Gedung --</option>
                    @foreach($gedungs as $g)
                        <option value="{{ $g->id }}" {{ old('gedung_id') == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                    @endforeach
                </select>
                @error('gedung_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="nomor_lantai" class="form-label fw-bold">Nomor Lantai</label>
                <input type="text" class="form-control @error('nomor_lantai') is-invalid @enderror" id="nomor_lantai" name="nomor_lantai" value="{{ old('nomor_lantai') }}" required>
                @error('nomor_lantai') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label for="keterangan" class="form-label fw-bold">Keterangan (Opsional)</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.lantai.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-save me-1"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
