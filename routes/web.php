<?php

use App\Http\Controllers\Admin\ManajemenKaryawanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('halamanUtamaMBG');
});

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('karyawan', ManajemenKaryawanController::class);
});

//Route untuk login karyawan
Route::get('/login-karyawan', [App\Http\Controllers\Karyawan\LoginKaryawanController::class, 'showLoginForm'])->name('login.karyawan.form');
Route::post('/login-karyawan', [App\Http\Controllers\Karyawan\LoginKaryawanController::class, 'login'])->name('login.karyawan');
Route::post('/logout-karyawan', [App\Http\Controllers\Karyawan\LoginKaryawanController::class, 'logout'])->name('logout.karyawan');

// Route::get('/karyawan', [ManajemenKaryawanController::class, 'index'])->name('karyawan.index');
// Route::post('/karyawan', [ManajemenKaryawanController::class, 'store'])->name('karyawan.store');
// Route::put('/karyawan/{id}', [ManajemenKaryawanController::class, 'update'])->name('karyawan.update');
// Route::delete('/karyawan/{id}', [ManajemenKaryawanController::class, 'destroy'])->name('karyawan.destroy');

require __DIR__ . '/auth.php';
