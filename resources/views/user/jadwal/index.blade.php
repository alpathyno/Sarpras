@extends('layouts.app')
@section('title', 'Lihat Jadwal Ruangan - SIM Sarpras')
@section('page_title', 'Jadwal Ruangan')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-success mb-3"><i class="fas fa-calendar-day me-2"></i> Jadwal Pemakaian Ruangan</h5>
        <p class="text-muted">Periksa ketersediaan ruangan sebelum Anda mengajukan peminjaman. Secara default, sistem menampilkan jadwal hari ini dan kedepannya.</p>
        
        <form action="{{ route('user.jadwal.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari kegiatan atau ruangan..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-3">
                    <select name="ruangan_id" class="form-select">
                        <option value="">-- Semua Ruangan (Dapat Dipinjam) --</option>
                        @foreach($ruangans as $r)
                            <option value="{{ $r->id }}" {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>{{ $r->nama_ruangan }} (Kapasitas: {{ $r->kapasitas }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-success w-100" type="submit"><i class="fas fa-search"></i> Cek Jadwal</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Ruangan</th>
                        <th>Lokasi</th>
                        <th>Kegiatan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $j)
                    <tr>
                        <td class="fw-bold">{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</td>
                        <td><span class="badge bg-secondary">{{ \Carbon\Carbon::parse($j->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->waktu_selesai)->format('H:i') }}</span></td>
                        <td class="fw-bold text-success">{{ $j->ruangan->nama_ruangan }}</td>
                        <td>{{ $j->ruangan->lantai->gedung->nama }} (Lt.{{ $j->ruangan->lantai->nomor_lantai }})</td>
                        <td>{{ $j->kegiatan }}</td>
                        <td>{{ $j->keterangan ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">
                            <i class="fas fa-check-circle fs-4 text-success d-block mb-2"></i>
                            Tidak ada jadwal yang ditemukan. Ruangan kemungkinan kosong.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $jadwals->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection