<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Laporan\LaporanController;
use App\Http\Controllers\Master\KategoriProdukController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Pembelian\PembelianKebutuhanController;
use App\Http\Controllers\Pembelian\PembelianProdukController;
use App\Http\Controllers\Penjualan\PenjualanProdukController;
use App\Http\Controllers\Persedian\ProdukController;
use App\Http\Controllers\Persedian\ProdukJualController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('master')->name('master.')->middleware(['auth'])->group(function(){
    //supplier
    Route::get('supplier/index', [SupplierController::class, 'index'])->name('supplier-index')->middleware(['cekLevel:1']);
    Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier-create')->middleware(['cekLevel:1']);
    Route::post('supplier/store', [SupplierController::class, 'store'])->name('supplier-store')->middleware(['cekLevel:1']);
    Route::get('supplier/edit/{id}', [SupplierController::class, 'edit'])->name('supplier-edit')->middleware(['cekLevel:1']);
    Route::patch('supplier/update{id}', [SupplierController::class, 'update'])->name('supplier-update')->middleware(['cekLevel:1']);

    //produk
    Route::get('produk/index', [KategoriProdukController::class, 'index'])->name('produk-index');
    Route::get('produk/create', [KategoriProdukController::class, 'create'])->name('produk-create');
    Route::post('produk/store', [KategoriProdukController::class, 'store'])->name('produk-store');
    Route::get('produk/edit/{id}', [KategoriProdukController::class, 'edit'])->name('produk-edit');
    Route::patch('produk/update{id}', [KategoriProdukController::class, 'update'])->name('produk-update');

    //user
    Route::get('user/index', [UserController::class, 'index'])->name('user-index')->middleware(['cekLevel:1']);
    Route::get('user/create', [UserController::class, 'create'])->name('user-create')->middleware(['cekLevel:1']);
    Route::post('user/store', [UserController::class, 'store'])->name('user-store')->middleware(['cekLevel:1']);
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user-edit')->middleware(['cekLevel:1']);
    Route::patch('user/update/{id}', [UserController::class, 'update'])->name('user-update')->middleware(['cekLevel:1']);
});

Route::prefix('persediaan')->name('persediaan.')->middleware('auth')->group(function(){
    //produk jual
    Route::get('jual/index', [ProdukJualController::class, 'index'])->name('jual-index');
    Route::get('jual/create', [ProdukJualController::class, 'create'])->name('jual-create');
    Route::post('jual/store', [ProdukJualController::class, 'store'])->name('jual-store');
    Route::get('jual/edit/{id}', [ProdukJualController::class, 'edit'])->name('jual-edit');
    Route::patch('jual/update/{id}', [ProdukJualController::class, 'update'])->name('jual-update');
});

Route::prefix('pembelian')->name('pembelian.')->middleware('auth')->group(function(){
    //pembelian produk
    Route::get('produk/index', [PembelianProdukController::class, 'index'])->name('produk-index');
    Route::get('produk/create', [PembelianProdukController::class, 'create'])->name('produk-create');
    Route::post('produk/store', [PembelianProdukController::class, 'store'])->name('produk-store');
    Route::get('produk/edit/{id}', [PembelianProdukController::class, 'edit'])->name('produk-edit');
    Route::patch('produk/update/{id}', [PembelianProdukController::class, 'update'])->name('produk-update');

    //pembelian kebutuhan lainnya
    Route::get('lainnya/index', [PembelianKebutuhanController::class, 'index'])->name('lainnya-index');
    Route::get('lainnya/create', [PembelianKebutuhanController::class, 'create'])->name('lainnya-create');
    Route::post('lainnya/store', [PembelianKebutuhanController::class, 'store'])->name('lainnya-store');
    Route::get('lainnya/edit/{id}', [PembelianKebutuhanController::class, 'edit'])->name('lainnya-edit');
    Route::patch('lainnya/update/{id}', [PembelianKebutuhanController::class, 'update'])->name('lainnya-update');
});

Route::prefix('penjualan')->name('penjualan.')->middleware('auth')->group(function(){
    //penjualan produk
    Route::get('produk/index', [PenjualanProdukController::class, 'index'])->name('produk-index');
    Route::get('produk/create', [PenjualanProdukController::class, 'create'])->name('produk-create');
    Route::post('produk/store', [PenjualanProdukController::class, 'store'])->name('produk-store');
    Route::get('produk/edit/{id}', [PenjualanProdukController::class, 'edit'])->name('produk-edit');
    Route::get('produk/show/{id}', [PenjualanProdukController::class, 'show'])->name('produk-show');
    Route::patch('produk/update/{id}', [PenjualanProdukController::class, 'update'])->name('produk-update');
});

Route::prefix('laporan')->name('laporan.')->middleware('auth')->group(function(){
    //lapporan penjualan
    Route::get('penjualan/index', [LaporanController::class, 'indexPenjualan'])->name('penjualan-index');
    Route::get('penjualan/show/{id}', [LaporanController::class, 'showPenjualan'])->name('penjualan-show');
    
    //lapporan pembelian
    Route::get('pembelian/index', [LaporanController::class, 'indexPembelian'])->name('pembelian-index');
    Route::get('pembelian/show/{id}', [LaporanController::class, 'showPembelian'])->name('pembelian-show');
    
    //lapporan keuangan
    Route::get('keuangan/index', [LaporanController::class, 'indexKeuangan'])->name('keuangan-index');
    Route::get('keuangan/ubahPeriode', [LaporanController::class, 'ubahPeriode'])->name('keuangan-ubahPeriode');
    Route::get('keuangan/data/{awal}/{akhir}', [LaporanController::class, 'dataKeuangan'])->name('keuangan-data');
    Route::get('keuangan/exportPDF/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('keuangan-exportPDF');
});