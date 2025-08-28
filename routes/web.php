<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\KenaliKerjaController;
use App\Http\Controllers\MateriSiswaController;
use App\Http\Controllers\TopikMateriController;
use App\Http\Controllers\ProfesiKerjaController;
use App\Http\Controllers\KategoriMinatController;

use App\Http\Controllers\KontribusiSdgsController;
use App\Http\Controllers\EksplorasiKerjaController;
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

    Route::resource('topik-materi', TopikMateriController::class)->names('admin.topik.materi');

    Route::resource('materi', MateriController::class)->names('admin.materi');

    Route::get('/eksplorasi-profesi', [EksplorasiKerjaController::class, 'index'])->name('admin.eksplorasi-profesi.index');
    Route::prefix('eksplorasi-profesi')->name('admin.eksplorasi-profesi.')->group(function () {
        Route::resource('profesi-kerja', ProfesiKerjaController::class);
        Route::resource('industri', IndustriController::class);
        Route::resource('industri-profesi', IndustriProfesiController::class);
    });

    Route::get('/kenali-profesi', [KenaliKerjaController::class, 'index'])->name('admin.kenali-profesi.index');
    Route::prefix('kenali-profesi')->name('admin.kenali-profesi.')->group(function () {
        Route::resource('kategori-minat', KategoriMinatController::class);
        Route::resource('profesi-kategori', KategoriMinatController::class);
    });

    Route::get('/kontribusi-sdgs', [KontribusiSdgsController::class, 'index'])->name('admin.kontribusi-sdgs');
});

Route::prefix('siswa')->middleware(['auth', RoleMiddleware::class.':siswa'])->group(function () {
    Route::get('/dashboard/', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::post('/simpan-rencana', [SiswaController::class, 'simpanRencana'])->name('siswa.simpan.rencana');

    Route::resource('materi', MateriSiswaController::class)->names('siswa.materi');

    Route::resource('eksplorasi-kerja', EksplorasiKerjaSiswaController::class)->names('siswa.eksplorasi-kerja');
});
