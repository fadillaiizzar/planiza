<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return view('beranda'); 
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/redirect', [AuthController::class, 'redirectByRole'])->name('redirect');

    Route::get('/dashboard/pages/admin', [AdminController::class, 'index'])->middleware('auth');
    Route::get('/dashboard/pages/siswa', [SiswaController::class, 'index'])->name('<dashboard class="pages"></dashboard>siswa')->middleware('auth');
});

Route::post('/siswa/simpan-rencana', [SiswaController::class, 'simpanRencana'])->name('siswa.simpan.rencana');

