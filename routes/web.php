<?php

use App\Models\Materi;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\KontribusiSdgsController;
use App\Models\KontribusiSdgs;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/redirect', [AuthController::class, 'redirectByRole'])->name('redirect');
});

Route::middleware(['auth', RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/register', [AdminController::class, 'showRegister'])->name('register');
    Route::post('/register', [AdminController::class, 'register']);

    Route::get('/dashboard/pages/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/user/pages/admin', [UserController::class, 'index'])->name('admin.user');
    Route::get('/materi/pages/admin', [MateriController::class, 'index'])->name('admin.materi');
    Route::get('/kontribusi-sdgs/pages/admin', [KontribusiSdgsController::class, 'index'])->name('admin.kontribusi-sdgs');
});

Route::middleware(['auth', RoleMiddleware::class.':siswa'])->group(function () {
    Route::get('/dashboard/pages/siswa', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::post('/siswa/simpan-rencana', [SiswaController::class, 'simpanRencana'])->name('siswa.simpan.rencana');
    Route::get('/materi/pages/siswa', [MateriController::class, 'index'])->name('siswa.materi');
});
