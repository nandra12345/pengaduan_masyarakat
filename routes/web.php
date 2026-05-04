<?php

use Illuminate\Support\Facades\Route;

// Controllers Auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Controllers Masyarakat
use App\Http\Controllers\Masyarakat\DashboardController    as MasyarakatDashboard;
use App\Http\Controllers\Masyarakat\PengaduanController    as MasyarakatPengaduan;
use App\Http\Controllers\Masyarakat\ProfileController      as MasyarakatProfile;

// Controllers Petugas
use App\Http\Controllers\Petugas\DashboardController       as PetugasDashboard;
use App\Http\Controllers\Petugas\PengaduanController       as PetugasPengaduan;

// Controllers Admin
use App\Http\Controllers\Admin\LaporanController           as AdminLaporan;
use App\Http\Controllers\Admin\PetugasController           as AdminPetugas;
use App\Http\Controllers\RekapController;

use App\Http\Controllers\Masyarakat\DashboardController;
Route::get('/tentang-kami', [DashboardController::class, 'tentangKami'])->name('tentang-kami');
/*
|--------------------------------------------------------------------------
| Redirect root ke halaman login
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect()->route('login'));

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (guest only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'showForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.post');

    // Registrasi Masyarakat
    Route::get('/register', [RegisterController::class, 'showForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.post');
});

/*
|--------------------------------------------------------------------------
| LOGOUT (semua role)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| MASYARAKAT ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth.masyarakat')
    ->prefix('masyarakat')
    ->name('masyarakat.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [MasyarakatDashboard::class, 'index'])
            ->name('dashboard');

        // CRUD Pengaduan
        Route::get('/pengaduan', [MasyarakatPengaduan::class, 'index'])
            ->name('pengaduan.index');

        Route::get('/pengaduan/buat', [MasyarakatPengaduan::class, 'create'])
            ->name('pengaduan.create');

        Route::post('/pengaduan', [MasyarakatPengaduan::class, 'store'])
            ->name('pengaduan.store');

        Route::get('/pengaduan/{id}', [MasyarakatPengaduan::class, 'show'])
            ->name('pengaduan.show');

        // ==============================
        // PROFILE
        // ==============================
        Route::get('/profile', [MasyarakatProfile::class, 'index'])
            ->name('profile.index');

        Route::get('/profile/edit', [MasyarakatProfile::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [MasyarakatProfile::class, 'update'])
            ->name('profile.update');

        Route::get('/profile/password', [MasyarakatProfile::class, 'editPassword'])
            ->name('profile.password');

        Route::put('/profile/password', [MasyarakatProfile::class, 'updatePassword'])
            ->name('profile.password.update');
    });

/*
|--------------------------------------------------------------------------
| PETUGAS ROUTES (Petugas & Admin)
|--------------------------------------------------------------------------
*/
Route::middleware('auth.petugas')
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [PetugasDashboard::class, 'index'])
            ->name('dashboard');

        // Manajemen Pengaduan
        Route::get('/pengaduan', [PetugasPengaduan::class, 'index'])
            ->name('pengaduan.index');

        Route::get('/pengaduan/{id}', [PetugasPengaduan::class, 'show'])
            ->name('pengaduan.show');

        Route::post('/pengaduan/{id}/tanggapi', [PetugasPengaduan::class, 'tanggapi'])
            ->name('pengaduan.tanggapi');
    });

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Admin only)
|--------------------------------------------------------------------------
*/
Route::middleware('auth.admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Rekap & Cetak Laporan
        Route::get('/laporan', [AdminLaporan::class, 'index'])
            ->name('laporan.index');

        Route::get('/laporan/cetak', [AdminLaporan::class, 'cetak'])
            ->name('laporan.cetak');

        // Manajemen Akun Petugas
        Route::get('/petugas', [AdminPetugas::class, 'index'])
            ->name('petugas.index');

        Route::get('/petugas/tambah', [AdminPetugas::class, 'create'])
            ->name('petugas.create');

        Route::post('/petugas', [AdminPetugas::class, 'store'])
            ->name('petugas.store');

        Route::get('/petugas/{id}/edit', [AdminPetugas::class, 'edit'])
            ->name('petugas.edit');

        Route::put('/petugas/{id}', [AdminPetugas::class, 'update'])
            ->name('petugas.update');

        Route::delete('/petugas/{id}', [AdminPetugas::class, 'destroy'])
            ->name('petugas.destroy');
    });