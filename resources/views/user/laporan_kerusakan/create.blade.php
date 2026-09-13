@extends('layouts.app')
@section('title', 'Lapor Kerusakan - SIM Sarpras')
@section('page_title', 'Form Lapor Kerusakan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-danger mb-4"><i class="fas fa-exclamation-triangle me-2"></i> Lapor Kerusakan Aset</h5>
        
        <form action="{{ route('user.laporan_kerusakan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="aset_id" class="form-label fw-bold">Pilih Aset yang Rusak</label>
                <select class="form-select @error('aset_id') is-invalid @enderror" id="aset_id" name="aset_id" required>
                    <option value="">-- Pilih Aset --</option>
                    @foreach($asets as $a)
                        <option value="{{ $a->id }}" {{ old('aset_id') == $a->id ? 'selected' : '' }}>{{ $a->kode_aset }} - {{ $a->nama_aset }} (Lokasi: {{ $a->ruangan->nama_ruangan ?? 'Tidak diketahui' }})</option>
                    @endforeach
                </select>
                @error('aset_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-bold">Deskripsi Kerusakan</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan secara detail bagian mana yang rusak dan bagaimana kondisinya..." required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="mb-4">
                <label for="foto" class="form-label fw-bold">Upload Foto Bukti Kerusakan</label>
                <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/jpg, image/webp" required>
                <small class="text-muted">Maksimal 2MB. Format: JPG, PNG, WEBP.</small>
                @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('user.laporan_kerusakan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-danger fw-bold"><i class="fas fa-paper-plane me-1"></i> Kirim Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection
