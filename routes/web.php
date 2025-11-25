<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

// Login halaman


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_proses'])->name('login.proses');


// Hanya untuk admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('departemen', DepartemenController::class); 
    Route::resource('staff', StaffController::class);
});


// Hanya untuk staff
Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.dashboard');
});
