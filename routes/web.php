<?php

use App\Models\Kampus;
use App\Models\KampusJurusan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SoalTesController;
use App\Http\Controllers\HasilTesController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\KenaliKerjaController;
use App\Http\Controllers\MateriSiswaController;
use App\Http\Controllers\OpsiJawabanController;
use App\Http\Controllers\TopikMateriController;
use App\Http\Controllers\PembelajaranController;
use App\Http\Controllers\ProfesiKerjaController;
use App\Http\Controllers\JurusanKuliahController;
use App\Http\Controllers\KampusJurusanController;
use App\Http\Controllers\KategoriMinatController;
use App\Http\Controllers\KontribusiSdgsController;
use App\Http\Controllers\EksplorasiKerjaController;
use App\Http\Controllers\IndustriProfesiController;
use App\Http\Controllers\ProfesiKategoriController;
use App\Http\Controllers\EksplorasiKuliahController;
use App\Http\Controllers\Siswa\KerjakanTesController;
use App\Http\Controllers\Siswa\JawabanSiswaController;
use App\Http\Controllers\Siswa\KenaliProfesiSiswaController;
use App\Http\Controllers\Siswa\RekomendasiProfesiController;
use App\Http\Controllers\Siswa\EksplorasiKerjaSiswaController;
use App\Http\Controllers\Siswa\EksplorasiKuliah\EksplorasiKuliahSiswaController;

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
        Route::resource('soal-tes', SoalTesController::class);
        Route::resource('opsi-jawaban', OpsiJawabanController::class);

        Route::post('/tes/{id}/set-active', [TesController::class, 'setActive'])->name('tes.setActive');

        Route::prefix('hasil-tes')->group(function () {
            Route::get('/', [HasilTesController::class, 'index'])->name('hasil-tes.index');
            Route::get('/{tes_id}', [HasilTesController::class, 'show'])->name('hasil-tes.show');

            Route::get('/{tes_id}/users', [HasilTesController::class, 'showUsers'])->name('hasil-tes.users');
            Route::get('/{tes_id}/user/{user_id}', [HasilTesController::class, 'showUserHistory'])->name('hasil-tes.user-history');

            Route::get('/{tes_id}/user/{user_id}/attempt/{attempt}', [HasilTesController::class, 'showAttempt'])->name('hasil-tes.attempt');
        });
    });

    Route::prefix('eksplorasi-jurusan')->name('eksplorasi-jurusan.')->group(function () {
        Route::get('/', [EksplorasiKuliahController::class, 'index'])->name('index');
        Route::resource('jurusan-kuliah', JurusanKuliahController::class);
        Route::resource('kampus', KampusController::class);

        Route::get('/kampus-jurusan/check', [KampusJurusanController::class, 'checkExists'])->name('kampus-jurusan.check');
        Route::resource('kampus-jurusan' , KampusJurusanController::class);
    });

    Route::get('/kontribusi-sdgs', [KontribusiSdgsController::class, 'index'])->name('kontribusi-sdgs');
});

Route::prefix('siswa')->middleware(['auth', RoleMiddleware::class.':siswa'])->name('siswa.')->group(function () {
    Route::get('/dashboard/', [SiswaController::class, 'index'])->name('dashboard');
    Route::post('/simpan-rencana', [SiswaController::class, 'simpanRencana'])->name('simpan.rencana');

    Route::resource('materi', MateriSiswaController::class)->names('materi');

    Route::resource('eksplorasi-profesi', EksplorasiKerjaSiswaController::class)->names('eksplorasi-profesi');

    Route::prefix('kenali-profesi')->name('kenali-profesi.')->group(function () {
        Route::get('/', [KenaliProfesiSiswaController::class, 'index'])->name('index');

        Route::get('/tes', [KerjakanTesController::class, 'index'])->name('tes.index');
        Route::post('/tes/{soal}/jawab', [JawabanSiswaController::class, 'store'])->name('tes.jawab');

        Route::post('/tes/{tes}/submit', [KerjakanTesController::class, 'submit'])->name('tes.submit');
        Route::get('/tes/{tes}/rekomendasi/{attempt?}', [RekomendasiProfesiController::class, 'index'])->name('tes.rekomendasi');
    });

    Route::resource('eksplorasi-jurusan', EksplorasiKuliahSiswaController::class)->names('eksplorasi-jurusan');
});
