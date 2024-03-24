<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminTransaksiDetailController;

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

Route::get('/login', function () {
    return view('auth/login');
});
Route::post('/login/do', [AdminAuthController::class, 'doLogin'])->middleware('guest');
Route::get('/logout', [AdminAuthController::class, 'logout'])->middleware('auth');

Route::get('/', function () {
    $data = [
        'content'   => 'admin.dashboard.index'
    ];
    return view('admin.layouts.wrapper', $data);
})->middleware('auth');

Route::get('/home', [HomeController::class,'index'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/admin')->middleware('auth')->group(function() {
    Route::get('/dashboard', function () {
        $data = [
            'content'   => 'admin.dashboard.index'
        ];
        return view('admin.layouts.wrapper', $data);
    });
    Route::get('/transaksi/detail/selesai/{id}', [AdminTransaksiDetailController::class, 'done']);
    Route::get('/transaksi/detail/delete', [AdminTransaksiDetailController::class, 'delete']);
    Route::post('/transaksi/detail/create', [AdminTransaksiDetailController::class, 'create']);
    Route::resource('/transaksi', AdminTransaksiController::class);
    Route::get('/transaksi/delete', [AdminTransaksiController::class, 'destroy']);
    Route::resource('/produk', AdminProdukController::class);
    Route::resource('/kategori', AdminKategoriController::class);
    Route::resource('/user', AdminUserController::class);
});

require __DIR__.'/auth.php';
