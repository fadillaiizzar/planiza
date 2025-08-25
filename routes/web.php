<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\MateriSiswaController;
use App\Http\Controllers\TopikMateriController;
use App\Http\Controllers\ProfesiKerjaController;
use App\Http\Controllers\KontribusiSdgsController;
use App\Http\Controllers\IndustriProfesiController;

use App\Http\Controllers\Siswa\EksplorasiKerjaSiswaController;

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
    // Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.user.reset-password');

    Route::resource('topik-materi', TopikMateriController::class)->names('admin.topik.materi');

    Route::resource('materi', MateriController::class)->names('admin.materi');

    Route::resource('profesi-kerja', ProfesiKerjaController::class)->names('admin.profesi-kerja');
    Route::resource('industri', IndustriController::class)->names('admin.industri');
    Route::resource('industri-profesi', IndustriProfesiController::class)->names('admin.industri-profesi');

    Route::get('/kontribusi-sdgs', [KontribusiSdgsController::class, 'index'])->name('admin.kontribusi-sdgs');
});

Route::prefix('siswa')->middleware(['auth', RoleMiddleware::class.':siswa'])->group(function () {
    Route::get('/dashboard/', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::post('/simpan-rencana', [SiswaController::class, 'simpanRencana'])->name('siswa.simpan.rencana');

    Route::resource('materi', MateriSiswaController::class)->names('siswa.materi');

    Route::resource('eksplorasi-kerja', EksplorasiKerjaSiswaController::class)->names('siswa.eksplorasi-kerja');
});
