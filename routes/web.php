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

Route::middleware(['auth', RoleMiddleware::class.':administrator,admin'])->group(function () {
    Route::get('/register', [AdminController::class, 'showRegister'])->name('register');
    Route::post('/register', [AdminController::class, 'register']);

    Route::get('/dashboard/pages/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users/{user}/detail', [AdminController::class, 'detailUser'])->name('admin.users.detail');
    Route::patch('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::post('/admin/users/{user}/reset-password', [AdminController::class, 'resetPassword'])->name('admin.users.reset-password');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    Route::get('/user/pages/admin', [UserController::class, 'index'])->name('admin.user');

    Route::resource('topik-materi/pages/admin', TopikMateriController::class) ->names('admin.topik.materi');

    Route::resource('materi/pages/admin', MateriController::class) ->names('admin.materi');

    Route::get('/kontribusi-sdgs/pages/admin', [KontribusiSdgsController::class, 'index'])->name('admin.kontribusi-sdgs');
});

Route::middleware(['auth', RoleMiddleware::class.':siswa'])->group(function () {
    Route::get('/dashboard/pages/siswa', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::post('/siswa/simpan-rencana', [SiswaController::class, 'simpanRencana'])->name('siswa.simpan.rencana');
    Route::get('/materi/pages/siswa', [MateriSiswaController::class, 'index'])->name('siswa.materi');
});
