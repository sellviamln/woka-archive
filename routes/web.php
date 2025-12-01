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
use NunoMaduro\Collision\Adapters\Phpunit\State;

// Login halaman


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_proses'])->name('login.proses');


// Hanya untuk admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('departemen', DepartemenController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('staff', StaffController::class);

    Route::patch('/user/{id}/status/active', [StaffController::class, 'setActive'])->name('user.status.active');
    Route::patch('/user/{id}/status/inactive', [StaffController::class, 'setInactive'])->name('user.status.inactive');


    Route::patch('/staff/{id}/akses/read', [StaffController::class, 'setRead'])->name('staff.akses.read');
    Route::patch('/staff/{id}/akses/write', [StaffController::class, 'setWrite'])->name('staff.akses.write');

    Route::resource('dokumen', DokumenController::class)->parameters(['dokumen' => 'dokumen']);
});


// Hanya untuk staff 
Route::prefix('staff')->name('staff.')->middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [StaffController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [StaffController::class, 'profileUpdate'])->name('profile.update');
});
