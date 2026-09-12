@extends('layouts.app')
@section('title', 'Pindah Aset - SIM Sarpras')
@section('page_title', 'Catat Perpindahan Aset')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-4">Form Mutasi/Pemindahan Aset</h5>
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.perpindahan_aset.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Aset (Hanya Tersedia)</label>
                <select name="aset_id" id="aset_select" class="form-select @error('aset_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Aset --</option>
                    @foreach($asets as $a)
                        <option value="{{ $a->id }}" data-ruangan="{{ $a->ruangan->nama_ruangan ?? '-' }}" {{ old('aset_id') == $a->id ? 'selected' : '' }}>
                            {{ $a->kode_aset }} - {{ $a->nama_aset }}
                        </option>
                    @endforeach
                </select>
                @error('aset_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Lokasi Saat Ini</label>
                <input type="text" id="lokasi_saat_ini" class="form-control bg-light" value="Pilih aset terlebih dahulu..." readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold text-primary">Pilih Ruangan Tujuan (Baru)</label>
                <select name="ruangan_tujuan_id" class="form-select @error('ruangan_tujuan_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Ruangan Tujuan --</option>
                    @foreach($ruangans as $r)
                        <option value="{{ $r->id }}" {{ old('ruangan_tujuan_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->nama_ruangan }} (Lantai {{ $r->lantai->nama_lantai ?? '-' }}, Gedung {{ $r->lantai->gedung->nama_gedung ?? '-' }})
                        </option>
                    @endforeach
                </select>
                @error('ruangan_tujuan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Tanggal Pemindahan</label>
                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
                @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Alasan Perpindahan</label>
                <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="2" required>{{ old('alasan') }}</textarea>
                @error('alasan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Keterangan Tambahan (Opsional)</label>
                <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan') }}</textarea>
            </div>

            <div class="alert alert-warning">
                <i class="fas fa-exclamation-circle me-1"></i> Setelah disimpan, lokasi di Master Data Aset akan otomatis berubah ke Ruangan Tujuan secara permanen.
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.perpindahan_aset.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-exchange-alt me-1"></i> Simpan Perpindahan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const asetSelect = document.getElementById('aset_select');
    const lokasiInput = document.getElementById('lokasi_saat_ini');
    
    asetSelect.addEventListener('change', function() {
        if(this.value) {
            const selectedOption = this.options[this.selectedIndex];
            lokasiInput.value = selectedOption.getAttribute('data-ruangan');
        } else {
            lokasiInput.value = 'Pilih aset terlebih dahulu...';
        }
    });

    // Trigger on load for old() values
    if(asetSelect.value) {
        asetSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection