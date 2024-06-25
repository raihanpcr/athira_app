<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeberangkatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\UserController;
use App\Models\Keberangkatan;

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

Route::get('/dashboard2', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    //dashboard

    //keberangkatan
    Route::get('/formKeberangkatan', function () {
        return view('keberangkatan.keberangkatan');
    });
    Route::get('/keberangkatan', [KeberangkatanController::class, 'index']);
    Route::get('/detailKeberangkatan/{keberangkatan}', [KeberangkatanController::class, 'showDetail'])->name('detailKeberangkatan');
    Route::post('/tambahKeberangkatan', [KeberangkatanController::class, 'store']);
    Route::put('/updateDataKeberangkatan/{id}', [KeberangkatanController::class, 'update'])->name('updateDataKeberangkatan');
    Route::delete('/hapusKeberangkatan/{keberangkatan}', [KeberangkatanController::class, 'destroy'])->name('hapusKeberangkatan');

    //Mobile Route
    Route::get('/mobil',[MobilController::class, 'index']);
    Route::get('/mobil/add',[MobilController::class, 'add'])->name('formMobil');
    Route::get('/mobil/detail/{mobil}',[MobilController::class, 'show'])->name('detailMobil');
    Route::post('/mobil/add',[MobilController::class, 'create'])->name('tambahMobil');
    Route::put('/mobil/updateMobil/{mobil}', [MobilController::class, 'update'])->name('updateMobil');
    Route::delete('/mobil/{mobil}',[MobilController::class, 'destroy'])->name('hapusMobil');

    // Profile
    Route::get('/profile', function () {
        return view('profile');
    });
    
    Route::get('/profile/detail/{id}', [UserController::class,'showProfile'])->name('detailProfil');
    Route::put('/profile/update/{id}', [UserController::class,'update'])->name('updateProfil');
    
    Route::get('/pemesanan', function () {
        return view('pemesanan');
    });
    Route::get('/cetak_tiket', function () {
        return view('cetakTiket');
    });
    Route::get('/', [KeberangkatanController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [UserController::class, 'index']);
    Route::post('/register', [UserController::class, 'store']);
});
