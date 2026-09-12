<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/notifikasi/mark-read', [App\Http\Controllers\NotifikasiController::class, 'markAllRead'])->name('notifikasi.markAllRead');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('gedung', App\Http\Controllers\GedungController::class);
        Route::resource('lantai', App\Http\Controllers\LantaiController::class);
        Route::resource('ruangan', App\Http\Controllers\RuanganController::class);
        Route::resource('kategori_aset', App\Http\Controllers\KategoriAsetController::class);
        Route::resource('aset', App\Http\Controllers\AsetController::class);
        Route::resource('jadwal_ruangan', App\Http\Controllers\JadwalRuanganController::class);
        
        Route::get('peminjaman', [App\Http\Controllers\AdminPeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('peminjaman/{peminjaman}', [App\Http\Controllers\AdminPeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::post('peminjaman/{peminjaman}/approve', [App\Http\Controllers\AdminPeminjamanController::class, 'approve'])->name('peminjaman.approve');
        Route::post('peminjaman/{peminjaman}/reject', [App\Http\Controllers\AdminPeminjamanController::class, 'reject'])->name('peminjaman.reject');

        Route::get('pengembalian', [App\Http\Controllers\AdminPengembalianController::class, 'index'])->name('pengembalian.index');
        Route::get('pengembalian/{id}', [App\Http\Controllers\AdminPengembalianController::class, 'show'])->name('pengembalian.show');
        Route::post('pengembalian/{id}', [App\Http\Controllers\AdminPengembalianController::class, 'process'])->name('pengembalian.process');

        Route::resource('laporan_kerusakan', App\Http\Controllers\AdminLaporanKerusakanController::class)->except(['create', 'store', 'destroy']);
        Route::resource('pemeliharaan', App\Http\Controllers\AdminPemeliharaanController::class);
        Route::resource('perpindahan_aset', App\Http\Controllers\AdminPerpindahanAsetController::class)->except(['edit', 'update', 'destroy']);

        // Laporan
        Route::get('laporan', [App\Http\Controllers\AdminLaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/aset', [App\Http\Controllers\AdminLaporanController::class, 'aset'])->name('laporan.aset');
        Route::get('laporan/peminjaman', [App\Http\Controllers\AdminLaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
    });

    // User Routes (Accessible by Admin, Dosen, Mahasiswa)
    Route::get('/jadwal', [App\Http\Controllers\UserJadwalController::class, 'index'])->name('user.jadwal.index');
    Route::resource('peminjaman', App\Http\Controllers\UserPeminjamanController::class)->names('user.peminjaman');
    Route::resource('laporan_kerusakan', App\Http\Controllers\UserLaporanKerusakanController::class)->names('user.laporan_kerusakan')->only(['index', 'create', 'store', 'show']);
});
