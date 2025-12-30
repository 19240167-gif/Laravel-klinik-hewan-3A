<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemilikHewanController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        switch ($role) {
            case 'admin':
                return redirect('/dashboard');
            case 'pegawai':
                return redirect('/pemilik-hewan');
            case 'dokter':
                return redirect('/pemeriksaan');
        }
    }
    return redirect('/login');
});

// Routes yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    
    // Dashboard untuk Admin
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('role:admin')->name('dashboard');

    // Routes untuk Pegawai dan Admin - CRUD Pemilik Hewan (Offline)
    Route::middleware(['role:admin,pegawai'])->group(function () {
        Route::resource('pemilik-hewan', PemilikHewanController::class);
        Route::resource('hewan', HewanController::class);
        Route::resource('pendaftaran', PendaftaranController::class);
        
        // AJAX endpoint untuk get hewan by pemilik
        Route::get('api/hewan-by-pemilik/{id_pemilik_hewan}', [PendaftaranController::class, 'getHewanByPemilik'])->name('api.hewan-by-pemilik');
    });

    // Routes untuk Dokter dan Admin - Pemeriksaan
    Route::middleware(['role:admin,dokter'])->group(function () {
        Route::resource('pemeriksaan', PemeriksaanController::class);
    });
});
