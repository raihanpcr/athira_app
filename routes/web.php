<?php

use App\Http\Controllers\EstimasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeberangkatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\SupirController;
use App\Http\Controllers\UserController;
use App\Models\Keberangkatan;
use App\Models\Pesanan;

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
    Route::get('/formKeberangkatan', [KeberangkatanController::class, 'form']);
    Route::get('/keberangkatan', [KeberangkatanController::class, 'index']);
    Route::get('/detailKeberangkatan/{keberangkatan}', [KeberangkatanController::class, 'showDetail'])->name('detailKeberangkatan');
    Route::post('/tambahKeberangkatan', [KeberangkatanController::class, 'store']);
    Route::put('/updateDataKeberangkatan/{id}', [KeberangkatanController::class, 'update'])->name('updateDataKeberangkatan');
    Route::delete('/hapusKeberangkatan/{keberangkatan}', [KeberangkatanController::class, 'destroy'])->name('hapusKeberangkatan');

    //Ordera / Pesanan
    Route::get('/pesanan', [PesananController::class, 'index']);
    Route::get('/keberangkatan/order/{keberangkatan}', [KeberangkatanController::class, 'orderKeberangkatan'])->name('viewOrder');
    Route::get('/pesanan/cancle/{pesanan}', [PesananController::class, 'show'])->name('cancleForm');
    Route::get('/pesanan/detail/{pesanan}', [PesananController::class, 'showDetail'])->name('showPesanan');
    Route::get('/pesanan/tiket/{pesanan}', [PesananController::class, 'viewPDF'])->name('viewPDF');
    Route::post('/pesanan/cancle/{pesanan}', [PesananController::class, 'cancled'])->name('canclePesanan');
    Route::post('/pesanan/pesan', [PesananController::class, 'store'])->name('addOrder');

    //bayar
    Route::get('/pembayaran', [PesananController::class, 'bayar']);
    Route::post('/pembayaran/{pesanan}', [PesananController::class, 'konfirmasiPembayaran'])->name('konfirmasiPembayaran');

    //report
    Route::get('/laporan', [LaporanController::class, 'index']);

    //Mobile Route
    Route::get('/mobil',[MobilController::class, 'index']);
    Route::get('/mobil/tambahMobil',[MobilController::class, 'add'])->name('formMobil');
    Route::get('/mobil/detail/{mobil}',[MobilController::class, 'show'])->name('detailMobil');
    Route::post('/mobil/add',[MobilController::class, 'create'])->name('tambahMobil');
    Route::put('/mobil/updateMobil/{mobil}', [MobilController::class, 'update'])->name('updateMobil');
    Route::delete('/mobil/{mobil}',[MobilController::class, 'destroy'])->name('hapusMobil');

    //Supir
    Route::get('/supir',[SupirController::class, 'index']);
    Route::get('/supir/tambahSupir',[SupirController::class, 'create']);
    Route::get('/supir/detail/{supir}',[SupirController::class, 'show'])->name('detailSupir');
    Route::post('/supir/addSupir',[SupirController::class, 'store'])->name('addSupir');
    Route::put('/supir/updateSupir/{supir}', [SupirController::class, 'update'])->name('updateSupir');
    Route::delete('/supir/{supir}',[SupirController::class, 'destroy'])->name('hapusSupir');

    //Estimasi
    Route::get('/estimasi',[EstimasiController::class,'index']);
    Route::get('/estimasi/tambahKota',[EstimasiController::class, 'create']);
    Route::get('/estimasi/showKota/{estimasi}',[EstimasiController::class, 'show'])->name('showEstimasi');
    Route::post('/estimasi/tambahKota', [EstimasiController::class, 'store'])->name('addEstimasi');
    Route::put('/estimasi/update/{estimasi}', [EstimasiController::class, 'update'])->name('updateEstimasi');
    Route::delete('/estimasi/hapusKota/{estimasi}', [EstimasiController::class, 'destroy'])->name('deleteEstimasi');
    // Profile
    Route::get('/profile', function () {
        return view('profile');
    });
    
    Route::get('/profile/detail/{id}', [UserController::class,'showProfile'])->name('detailProfil');
    Route::put('/profile/update/{id}', [UserController::class,'update'])->name('updateProfil');
    
    Route::get('/pemesanan', [PesananController::class, 'index']);
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
