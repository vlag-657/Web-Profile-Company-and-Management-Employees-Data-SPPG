<?php

use App\Http\Controllers\Admin\ManajemenKaryawanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('halamanUtamaMBG');
});

//route untuk login karyawan
Route::get('/karyawan/login', [App\Http\Controllers\Karyawan\LoginKaryawanController::class, 'showLoginForm'])->name('karyawan.login');
Route::post('/karyawan/login', [App\Http\Controllers\Karyawan\LoginKaryawanController::class, 'login'])->name('karyawan.login.submit');
Route::post('/karyawan/logout', [App\Http\Controllers\Karyawan\LoginKaryawanController::class, 'logout'])->name('karyawan.logout');
Route::post('/karyawan/absen', [App\Http\Controllers\Karyawan\LoginKaryawanController::class, 'absen'])->name('karyawan.absen.submit');

Route::get('/karyawan/dashboard', [App\Http\Controllers\Karyawan\LoginKaryawanController::class, 'dashboard'])
    ->name('karyawan.dashboard')
    ->middleware('cek.karyawan'); 

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/absensi', [App\Http\Controllers\Admin\AbsensiController::class, 'index'])->name('admin.absensi');

    Route::resource('karyawan', ManajemenKaryawanController::class);
});

require __DIR__ . '/auth.php';
