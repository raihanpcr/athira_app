<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeberangkatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

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
    Route::get('/keberangkatan', [KeberangkatanController::class, 'index']);
    Route::get('/formKeberangkatan', function () {
        return view('keberangkatan');
    });
    Route::delete('/hapusKeberangkatan/{keberangkatan}', [KeberangkatanController::class, 'destroy'])->name('hapusKeberangkatan');
    Route::post('/tambahKeberangkatan', [KeberangkatanController::class, 'store']);

    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/profile', function () {
        return view('profile');
    });
    Route::get('/pemesanan', function () {
        return view('pemesanan');
    });
    Route::get('/cetak_tiket', function () {
        return view('cetakTiket');
    });
});

Route::get('/', [KeberangkatanController::class, 'index']);
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [UserController::class, 'index']);
    Route::post('/register', [UserController::class, 'store']);
});
