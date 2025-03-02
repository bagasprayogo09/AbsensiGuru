<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\Auth\AuthenticatedSessionGuruController;
use App\Http\Controllers\Auth\RegisteredGuruController;
use App\Http\Controllers\Auth\GuruPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruAbsensiController;
use App\Http\Controllers\GuruProfileController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\HistoryAbsensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KepalaYayasanController;
use App\Http\Controllers\GuruEditController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view ('auth.gurulogin');
});

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/kepala-yayasan/dashboard', [KepalaYayasanController::class, 'index'])->name('kepala_yayasan.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth:guru'])->group(function () {
    Route::get('/guru/edit', [GuruEditController::class, 'edit'])->name('guru.edit');
    Route::post('/guru/update', [GuruEditController::class, 'update'])->name('guru.update');
});


Route::prefix('admin/absensi')->middleware('auth')->group(function () {
    Route::get('/', [AbsensiController::class, 'index'])->name('admin.absensi.index'); // Menampilkan semua data absensi
    Route::get('/create', [AbsensiController::class, 'create'])->name('admin.absensi.create'); // Menampilkan form tambah absensi
    Route::post('/', [AbsensiController::class, 'store'])->name('admin.absensi.store'); // Menyimpan data absensi baru
    Route::get('/{absensi}/edit', [AbsensiController::class, 'edit'])->name('admin.absensi.edit'); // Menampilkan form edit absensi
    Route::put('/{absensi}', [AbsensiController::class, 'update'])->name('admin.absensi.update'); // Memperbarui data absensi
    Route::delete('/{absensi}', [AbsensiController::class, 'destroy'])->name('admin.absensi.destroy'); // Menghapus data absensi
    Route::get('/report', [AbsensiController::class, 'report'])->name('admin.absensi.report'); // Menampilkan halaman laporan
    Route::post('/report/generate', [AbsensiController::class, 'generateReport'])->name('admin.absensi.generateReport'); // Generate laporan
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('guru', GuruController::class);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('jadwal', JadwalController::class);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('mata_pelajaran', MataPelajaranController::class);

});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {
    Route::resource('admin', AdminController::class);
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('admin', AdminController::class);
});


Route::middleware(['auth:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruAbsensiController::class, 'dashboard'])->name('dashboard');
    Route::post('/absen', [GuruAbsensiController::class, 'absen'])->name('absen');
});

Route::middleware(['auth:guru'])->group(function () {
    Route::get('/guru/history-absensi', [HistoryAbsensiController::class, 'history'])->name('history.absensi');
});


Route::middleware(['auth:guru'])->group(function () {
    Route::get('/guru/profile', [GuruProfileController::class, 'edit'])->name('guru.profile.edit');
    Route::patch('/guru/profile', [GuruProfileController::class, 'update'])->name('guru.profile.update');
    Route::put('/guru/password/update', [GuruPasswordController::class, 'update'])->name('guru.password.update');
    Route::delete('/guru/profile', [GuruProfileController::class, 'destroy'])->name('guru.profile.destroy');
});

Route::prefix('guru')->name('guru.')->group(function () {
    // Route untuk registrasi
    Route::get('register', [RegisteredGuruController::class, 'create'])->name('register');
    Route::post('register', [RegisteredGuruController::class, 'store']);
    // Route untuk login
    Route::get('login', [AuthenticatedSessionGuruController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionGuruController::class, 'store']);
    // Route untuk logout
    Route::post('logout', [AuthenticatedSessionGuruController::class, 'destroy'])->name('logout');
    // Route yang dilindungi dengan middleware auth

});

require __DIR__.'/auth.php';
