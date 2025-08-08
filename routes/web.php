<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\KontribusiSdgsController;
use App\Models\Materi;

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

    Route::get('/dashboard/pages/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');
    Route::get('/user/pages/admin', [UserController::class, 'index'])->name('admin.user')->middleware('auth');
    Route::get('/materi/pages/admin', [MateriController::class, 'index'])->name('admin.materi')->middleware('auth');
    Route::get('/eksplorasi/pages/admin', function() {
        return view('admin.pages.eksplorasi');
    })->name('admin.eksplorasi');
    Route::get('/kenali-karier/pages/admin', function() {
        return view('admin.pages.kenali-karier');
    })->name('admin.kenali-karier');
    Route::get('/kontribusi-sdgs/pages/admin', [KontribusiSdgsController::class, 'index'])->name('admin.kontribusi-sdgs')->middleware('auth');
    Route::get('/bincang-karier/pages/admin', function() {
        return view('admin.pages.bincang-karier');
    })->name('admin.bincang-karier');

    Route::get('/dashboard/pages/siswa', [SiswaController::class, 'index'])->name('siswa.dashboard')->middleware('auth');
    Route::post('/siswa/simpan-rencana', [SiswaController::class, 'simpanRencana'])->name('siswa.simpan.rencana')->middleware('auth');
    Route::get('/materi/pages/siswa', [MateriController::class, 'index'])->name('siswa.materi')->middleware('auth');
});
