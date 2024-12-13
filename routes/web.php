<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Guru\GuruAbsensiController;
use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\GuruProfileController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin/matapelajaran')->name('admin.matapelajaran.')->group(function () {
    Route::get('/', [MataPelajaranController::class, 'index'])->name('index'); // Menampilkan daftar mata pelajaran
    Route::get('/create', [MataPelajaranController::class, 'create'])->name('create'); // Menampilkan form tambah mata pelajaran
    Route::post('/', [MataPelajaranController::class, 'store'])->name('store'); // Menyimpan mata pelajaran baru
    Route::get('/{mataPelajaran}/edit', [MataPelajaranController::class, 'edit'])->name('edit'); // Menampilkan form edit mata pelajaran
    Route::put('/{mataPelajaran}', [MataPelajaranController::class, 'update'])->name('update'); // Memperbarui mata pelajaran
    Route::delete('/{mataPelajaran}', [MataPelajaranController::class, 'destroy'])->name('destroy'); // Menghapus mata pelajaran
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');
    Route::post('/guru/absen', [GuruDashboardController::class, 'absen'])->name('guru.absen');
    Route::get('/guru/absensi/history',[GuruAbsensiController::class, 'history'])->name('guru.absensi.history');
    Route::get('/guru/profile', [GuruProfileController::class, 'edit'])->name('guru.profile.edit');
    Route::patch('/guru/profile', [GuruProfileController::class, 'update'])->name('guru.profile.update');
    Route::delete('/guru/profile', [GuruProfileController::class, 'destroy'])->name('guru.profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
Route::prefix('admin/guru')->name('admin.guru.')->group(function () {
    Route::get('/', [GuruController::class, 'index'])->name('index'); // Menampilkan daftar guru
    Route::get('/create', [GuruController::class, 'create'])->name('create'); // Menampilkan form untuk menambah guru
    Route::post('/', [GuruController::class, 'store'])->name('store'); // Menyimpan data guru baru
    Route::get('/{user}', [GuruController::class, 'show'])->name('show'); // Menampilkan detail guru
    Route::get('/{user}/edit', [GuruController::class, 'edit'])->name('edit'); // Menampilkan form untuk mengedit guru
    Route::put('/{user}', [GuruController::class, 'update'])->name('update'); // Mengupdate data guru
    Route::delete('/{user}', [GuruController::class, 'destroy'])->name('destroy'); // Menghapus guru
});

Route::prefix('admin/absensi')->group(function () {
    Route::get('/', [AbsensiController::class, 'index'])->name('admin.absensi.index'); // Menampilkan daftar absensi
    Route::get('/create', [AbsensiController::class, 'create'])->name('admin.absensi.create'); // Menampilkan form untuk menambah absensi
    Route::post('/', [AbsensiController::class, 'store'])->name('admin.absensi.store'); // Menyimpan absensi yang baru ditambahkan
    Route::get('/{id}/edit', [AbsensiController::class, 'edit'])->name('admin.absensi.edit');
    Route::put('/{id}', [AbsensiController::class, 'update'])->name('admin.absensi.update');
    Route::get('/export-pdf', [AbsensiController::class, 'exportPDF'])->name('admin.absensi.exportPDF'); // Ekspor absensi ke PDF
    Route::get('/laporan', [AbsensiController::class, 'laporanAbsensi'])->name('admin.absensi.laporan');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index'); // Menampilkan dashboard admin
    Route::get('/create', [AdminController::class, 'create'])->name('create'); // Halaman untuk menambah admin
    Route::post('/store', [AdminController::class, 'store'])->name('store'); // Proses menyimpan admin baru
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit'); // Route untuk edit
    Route::put('/{id}', [AdminController::class, 'update'])->name('update'); // Route untuk update
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
});

Route::prefix('admin/jadwal')->name('admin.jadwal.')->group(function () {
    Route::get('/', [JadwalController::class, 'index'])->name('index');
    Route::get('/create', [JadwalController::class, 'create'])->name('create');
    Route::post('/', [JadwalController::class, 'store'])->name('store');
    Route::get('/{jadwal}/edit', [JadwalController::class, 'edit'])->name('edit');
    Route::put('/{jadwal}', [JadwalController::class, 'update'])->name('update');
    Route::delete('/{jadwal}', [JadwalController::class, 'destroy'])->name('destroy');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

require __DIR__.'/auth.php';
