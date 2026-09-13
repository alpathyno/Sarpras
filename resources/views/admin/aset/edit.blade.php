@extends('layouts.app')
@section('title', 'Edit Aset - SIM Sarpras')
@section('page_title', 'Edit Aset')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Form Edit Aset</h5>
        <form action="{{ route('admin.aset.update', $aset->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kode_aset" class="form-label fw-bold">Kode Aset</label>
                    <input type="text" class="form-control @error('kode_aset') is-invalid @enderror" id="kode_aset" name="kode_aset" value="{{ old('kode_aset', $aset->kode_aset) }}" required>
                    @error('kode_aset') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nama_aset" class="form-label fw-bold">Nama Aset</label>
                    <input type="text" class="form-control @error('nama_aset') is-invalid @enderror" id="nama_aset" name="nama_aset" value="{{ old('nama_aset', $aset->nama_aset) }}" required>
                    @error('nama_aset') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kategori_id" class="form-label fw-bold">Kategori Aset</label>
                    <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id', $aset->kategori_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ruangan_id" class="form-label fw-bold">Lokasi Ruangan</label>
                    <select class="form-select @error('ruangan_id') is-invalid @enderror" id="ruangan_id" name="ruangan_id">
                        <option value="">-- Tidak ada lokasi --</option>
                        @foreach($ruangans as $r)
                            <option value="{{ $r->id }}" {{ old('ruangan_id', $aset->ruangan_id) == $r->id ? 'selected' : '' }}>{{ $r->nama_ruangan }} ({{ $r->kode_ruangan }})</option>
                        @endforeach
                    </select>
                    @error('ruangan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="tipe_aset" class="form-label fw-bold">Tipe Aset</label>
                    <select class="form-select @error('tipe_aset') is-invalid @enderror" id="tipe_aset" name="tipe_aset" required>
                        <option value="individual" {{ old('tipe_aset', $aset->tipe_aset) == 'individual' ? 'selected' : '' }}>Individual</option>
                        <option value="jumlah" {{ old('tipe_aset', $aset->tipe_aset) == 'jumlah' ? 'selected' : '' }}>Jumlah (Quantity)</option>
                    </select>
                    @error('tipe_aset') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="jumlah" class="form-label fw-bold">Jumlah</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', $aset->jumlah) }}" required min="1">
                    @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="kondisi" class="form-label fw-bold">Kondisi</label>
                    <select class="form-select @error('kondisi') is-invalid @enderror" id="kondisi" name="kondisi" required>
                        <option value="Baik" {{ old('kondisi', $aset->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ old('kondisi', $aset->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ old('kondisi', $aset->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    @error('kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="dapat_dipinjam" class="form-label fw-bold">Dapat Dipinjam?</label>
                    <select class="form-select @error('dapat_dipinjam') is-invalid @enderror" id="dapat_dipinjam" name="dapat_dipinjam" required>
                        <option value="1" {{ old('dapat_dipinjam', $aset->dapat_dipinjam) == '1' ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ old('dapat_dipinjam', $aset->dapat_dipinjam) == '0' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('dapat_dipinjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="Tersedia" {{ old('status', $aset->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Dipinjam" {{ old('status', $aset->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="Dalam Perbaikan" {{ old('status', $aset->status) == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                        <option value="Tidak Digunakan" {{ old('status', $aset->status) == 'Tidak Digunakan' ? 'selected' : '' }}>Tidak Digunakan</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="foto" class="form-label fw-bold">Ganti Foto Aset (Biarkan jika tidak diganti)</label>
                    @if($aset->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $aset->foto) }}" alt="Foto Aset" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                    <small class="text-muted">Maksimal 2MB. Format JPG/PNG/WEBP.</small>
                    @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mb-4">
                <label for="keterangan" class="form-label fw-bold">Keterangan (Opsional)</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $aset->keterangan) }}</textarea>
                @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.aset.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
