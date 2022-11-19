<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/customer/datatables', [\App\Http\Controllers\Master\CustomerController::class, 'datatables'])->name('customer.datatables');
Route::post('/customer/datatables/blokir', [\App\Http\Controllers\Master\CustomerController::class, 'datatablesBlokir'])->name('customer.datatables.blokir');

Route::post('/mobil/datatables', [\App\Http\Controllers\Master\MobilController::class, 'datatables'])->name('mobil.datatables');
Route::post('/mobil/datatables/blokir', [\App\Http\Controllers\Master\MobilController::class, 'datatablesBlokir'])->name('mobil.datatables.blokir');

Route::post('/mobil/blokir', [\App\Http\Controllers\Master\MobilController::class, 'blokir'])->name('mobil.blokir');
Route::post('/mobil/unblokir', [\App\Http\Controllers\Master\MobilController::class, 'unblokir'])->name('mobil.unblokir');
Route::delete('/mobil/destroy', [\App\Http\Controllers\Master\MobilController::class, 'destroy'])->name('mobil.destroy');

Route::post('/sopir/datatables', [\App\Http\Controllers\Master\SopirController::class, 'datatables'])->name('sopir.datatables');
Route::post('/sopir/datatables/blokir', [\App\Http\Controllers\Master\SopirController::class, 'datatablesBlokir'])->name('sopir.datatables.blokir');
Route::post('/sopir/blokir', [\App\Http\Controllers\Master\SopirController::class, 'blokir'])->name('sopir.blokir');
Route::post('/sopir/unblokir', [\App\Http\Controllers\Master\SopirController::class, 'unBlokir'])->name('sopir.unblokir');
Route::delete('/sopir/destroy', [\App\Http\Controllers\Master\SopirController::class, 'destroy'])->name('sopir.destroy');

Route::post('/bat/datatables', [\App\Http\Controllers\Transaksi\BatController::class, 'datatables'])->name('bat.datatables');
Route::post('/bat/datatables/blokir', [\App\Http\Controllers\Transaksi\BatController::class, 'datatablesBlokir'])->name('bat.datatables.blokir');
Route::delete('/bat/blokir', [\App\Http\Controllers\Transaksi\BatController::class, 'blokir'])->name('bat.blokir');
Route::delete('/bat/unblokir', [\App\Http\Controllers\Transaksi\BatController::class, 'unBlokir'])->name('bat.unblokir');
Route::delete('/bat/destroy', [\App\Http\Controllers\Transaksi\BatController::class, 'destroy'])->name('bat.destroy');

Route::post('/lamong/datatables', [\App\Http\Controllers\Transaksi\LamongController::class, 'datatables'])->name('lamong.datatables');
Route::post('/lamong/datatables/blokir', [\App\Http\Controllers\Transaksi\LamongController::class, 'datatablesBlokir'])->name('lamong.datatables.blokir');
Route::post('/lamong/blokir', [\App\Http\Controllers\Transaksi\LamongController::class, 'blokir'])->name('lamong.blokir');
Route::post('/lamong/unblokir', [\App\Http\Controllers\Transaksi\LamongController::class, 'unBlokir'])->name('lamong.unblokir');
Route::delete('/lamong/destroy', [\App\Http\Controllers\Transaksi\LamongController::class, 'destroy'])->name('lamong.destroy');

Route::post('/stid/datatables', [\App\Http\Controllers\Transaksi\STIDController::class, 'datatables'])->name('stid.datatables');
Route::post('/stid/datatables/blokir', [\App\Http\Controllers\Transaksi\STIDController::class, 'datatablesBlokir'])->name('stid.datatables.blokir');
Route::post('/stid/blokir', [\App\Http\Controllers\Transaksi\STIDController::class, 'blokir'])->name('stid.blokir');
Route::post('/stid/unblokir', [\App\Http\Controllers\Transaksi\STIDController::class, 'unBlokir'])->name('stid.unblokir');
Route::delete('/stid/destroy', [\App\Http\Controllers\Transaksi\STIDController::class, 'destroy'])->name('stid.destroy');

Route::post('/mypertamina/datatables', [\App\Http\Controllers\Transaksi\MyPertaminaController::class, 'datatables'])->name('mypertamina.datatables');
Route::post('/mypertamina/datatables/blokir', [\App\Http\Controllers\Transaksi\MyPertaminaController::class, 'datatablesBlokir'])->name('mypertamina.datatables.blokir');
Route::post('/mypertamina/blokir', [\App\Http\Controllers\Transaksi\MyPertaminaController::class, 'blokir'])->name('mypertamina.blokir');
Route::post('/mypertamina/unblokir', [\App\Http\Controllers\Transaksi\MyPertaminaController::class, 'unBlokir'])->name('mypertamina.unblokir');
Route::delete('/mypertamina/destroy', [\App\Http\Controllers\Transaksi\MyPertaminaController::class, 'destroy'])->name('mypertamina.destroy');
