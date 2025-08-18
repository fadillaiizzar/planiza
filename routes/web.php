<?php

use App\Models\Materi;
use App\Models\KontribusiSdgs;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\MateriSiswaController;
use App\Http\Controllers\TopikMateriController;
use App\Http\Controllers\KontribusiSdgsController;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/redirect', [AuthController::class, 'redirectByRole'])->name('redirect');
});

Route::prefix('admin')->middleware(['auth', RoleMiddleware::class.':administrator,admin'])->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('register');
    Route::post('/register', [UserController::class, 'store']);

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('users', UserController::class)->names('admin.user');
    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.user.reset-password');

    Route::resource('topik-materi', TopikMateriController::class)->names('admin.topik.materi');

    Route::resource('materi', MateriController::class)->names('admin.materi');

    Route::get('/kontribusi-sdgs', [KontribusiSdgsController::class, 'index'])->name('admin.kontribusi-sdgs');
});

Route::prefix('siswa')->middleware(['auth', RoleMiddleware::class.':siswa'])->group(function () {
    Route::get('/dashboard/', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::post('/simpan-rencana', [SiswaController::class, 'simpanRencana'])->name('siswa.simpan.rencana');
    Route::get('/materi', [MateriSiswaController::class, 'index'])->name('siswa.materi');
});
