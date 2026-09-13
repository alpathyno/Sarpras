@extends('layouts.app')
@section('title', 'Edit Kategori Aset - SIM Sarpras')
@section('page_title', 'Edit Kategori Aset')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Form Edit Kategori Aset</h5>
        <form action="{{ route('admin.kategori_aset.update', $kategoriAset->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_kategori" class="form-label fw-bold">Nama Kategori</label>
                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategoriAset->nama_kategori) }}" required>
                @error('nama_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label for="keterangan" class="form-label fw-bold">Keterangan (Opsional)</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $kategoriAset->keterangan) }}</textarea>
                @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.kategori_aset.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
