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
use App\Http\Controllers\PembelajaranController;
use App\Http\Controllers\ProfesiKerjaController;
use App\Http\Controllers\KategoriMinatController;
use App\Http\Controllers\KontribusiSdgsController;
use App\Http\Controllers\EksplorasiKerjaController;
use App\Http\Controllers\IndustriProfesiController;
use App\Http\Controllers\ProfesiKategoriController;
use App\Http\Controllers\Siswa\EksplorasiKerjaSiswaController;
use App\Http\Controllers\TesController;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/redirect', [AuthController::class, 'redirectByRole'])->name('redirect');
});

Route::prefix('admin')->middleware(['auth', RoleMiddleware::class.':administrator,admin'])->name('admin.')->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('register');
    Route::post('/register', [UserController::class, 'store']);

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class)->names('user');

    Route::prefix('pembelajaran')->name('pembelajaran.')->group(function () {
        Route::get('/', [PembelajaranController::class, 'index'])->name('index');
        Route::resource('topik-materi', TopikMateriController::class);
        Route::resource('materi', MateriController::class);
    });

    Route::prefix('eksplorasi-profesi')->name('eksplorasi-profesi.')->group(function () {
        Route::get('/', [EksplorasiKerjaController::class, 'index'])->name('index');
        Route::resource('profesi-kerja', ProfesiKerjaController::class);
        Route::resource('industri', IndustriController::class);
        Route::resource('industri-profesi', IndustriProfesiController::class);
    });

    Route::prefix('kenali-profesi')->name('kenali-profesi.')->group(function () {
        Route::get('/', [KenaliKerjaController::class, 'index'])->name('index');
        Route::resource('kategori-minat', KategoriMinatController::class);
        Route::resource('profesi-kategori', ProfesiKategoriController::class);
        Route::resource('tes', TesController::class);
    });

    Route::get('/kontribusi-sdgs', [KontribusiSdgsController::class, 'index'])->name('kontribusi-sdgs');
});

Route::prefix('siswa')->middleware(['auth', RoleMiddleware::class.':siswa'])->name('siswa.')->group(function () {
    Route::get('/dashboard/', [SiswaController::class, 'index'])->name('dashboard');
    Route::post('/simpan-rencana', [SiswaController::class, 'simpanRencana'])->name('simpan.rencana');

    Route::resource('materi', MateriSiswaController::class)->names('materi');

    Route::resource('eksplorasi-profesi', EksplorasiKerjaSiswaController::class)->names('eksplorasi-profesi');
});
