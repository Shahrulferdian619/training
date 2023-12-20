<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', [ProfileController::class, 'index']);
Route::get('get/json', [ProfileController::class, 'getData'])->name('get-json');
Route::get('get/json/id/{id}', [ProfileController::class, 'getDataId'])->name('get-json-id');
Route::post('store/json', [ProfileController::class, 'storeData'])->name('store-json');


