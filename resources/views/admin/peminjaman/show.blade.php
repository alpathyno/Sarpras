@extends('layouts.app')
@section('title', 'Detail Approval - SIM Sarpras')
@section('page_title', 'Detail Approval Peminjaman')
@section('content')
<div class="card card-stat bg-white mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-bold text-success m-0">Review Permohonan #{{ $peminjaman->id }}</h5>
            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="35%" class="bg-light">Peminjam</th>
                        <td>{{ $peminjaman->user->nama }} ({{ ucfirst($peminjaman->user->role) }})</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Tgl Pengajuan</th>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pengajuan)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Status Saat Ini</th>
                        <td>
                            @if($peminjaman->status === 'Menunggu') <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                            @elseif($peminjaman->status === 'Disetujui') <span class="badge bg-success">Disetujui</span>
                            @elseif($peminjaman->status === 'Selesai') <span class="badge bg-primary">Selesai</span>
                            @else <span class="badge bg-danger">Ditolak</span> @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Jadwal Mulai</th>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Jadwal Selesai</th>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Tujuan Kegiatan</th>
                        <td>{{ $peminjaman->tujuan }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="card border-success mb-3">
                    <div class="card-header bg-success text-white fw-bold">Item yang Diminta ({{ ucfirst($peminjaman->jenis) }})</div>
                    <ul class="list-group list-group-flush">
                        @foreach($peminjaman->details as $d)
                            <li class="list-group-item">
                                @if($peminjaman->jenis === 'ruangan')
                                    <strong>{{ $d->ruangan->nama_ruangan }}</strong><br>
                                    Lokasi: {{ $d->ruangan->lantai->gedung->nama }} Lt. {{ $d->ruangan->lantai->nomor_lantai }}<br>
                                    Kapasitas: {{ $d->ruangan->kapasitas }} org
                                @else
                                    <strong>{{ $d->aset->nama_aset }}</strong><br>
                                    Tipe: {{ ucfirst($d->aset->tipe_aset) }}<br>
                                    Jumlah Diajukan: <span class="badge bg-primary fs-6">{{ $d->jumlah }}</span><br>
                                    Stok Fisik Tersedia: {{ $d->aset->jumlah }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                @if($peminjaman->status === 'Menunggu')
                <div class="card">
                    <div class="card-body bg-light">
                        <form action="{{ route('admin.peminjaman.approve', $peminjaman->id) }}" method="POST" id="form-approve" class="d-inline">
                            @csrf
                            <input type="hidden" name="catatan" id="catatan-approve">
                        </form>
                        <form action="{{ route('admin.peminjaman.reject', $peminjaman->id) }}" method="POST" id="form-reject" class="d-inline">
                            @csrf
                            <input type="hidden" name="catatan" id="catatan-reject">
                        </form>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan Keputusan (Opsional)</label>
                            <textarea class="form-control" id="input-catatan" rows="3" placeholder="Alasan disetujui atau ditolak..."></textarea>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-danger" onclick="submitReject()"><i class="fas fa-times me-1"></i> Tolak Peminjaman</button>
                            <button type="button" class="btn btn-success" onclick="submitApprove()"><i class="fas fa-check me-1"></i> Setujui Peminjaman</button>
                        </div>
                    </div>
                </div>
                
                <script>
                    function submitApprove() {
                        if(confirm('Yakin ingin menyetujui peminjaman ini? Pastikan tidak ada jadwal yang bentrok.')) {
                            document.getElementById('catatan-approve').value = document.getElementById('input-catatan').value;
                            document.getElementById('form-approve').submit();
                        }
                    }
                    function submitReject() {
                        if(confirm('Yakin ingin menolak peminjaman ini?')) {
                            document.getElementById('catatan-reject').value = document.getElementById('input-catatan').value;
                            document.getElementById('form-reject').submit();
                        }
                    }
                </script>
                @endif
                
                @if($peminjaman->status != 'Menunggu')
                <div class="alert @if($peminjaman->status == 'Disetujui' || $peminjaman->status == 'Selesai') alert-success @else alert-danger @endif mt-3">
                    <strong>Peminjaman ini telah diproses.</strong><br>
                    Status: <strong>{{ $peminjaman->status }}</strong><br>
                    Oleh Admin: {{ $peminjaman->admin->nama ?? '-' }}<br>
                    Catatan: {{ $peminjaman->catatan ?? '-' }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection