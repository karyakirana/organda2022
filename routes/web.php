<?php

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

Route::get('/', function () {
    return view('pages.dashboard');
});

/** Master Route */
Route::get('master/customer', [\App\Http\Controllers\Master\CustomerController::class, 'index'])->name('customer');
Route::get('master/customer/blokir', [\App\Http\Controllers\Master\CustomerController::class, 'blokir'])->name('customer.blokir');

Route::get('master/mobil', [\App\Http\Controllers\Master\MobilController::class, 'index'])->name('mobil');
Route::get('master/mobil/blokir', [\App\Http\Controllers\Master\MobilController::class, 'indexBlokir']);
Route::get('master/mobil/form', \App\Http\Livewire\Master\MobilForm::class)->name('mobil.form');
Route::get('master/mobil/form/{idMobil}', \App\Http\Livewire\Master\MobilForm::class);

Route::get('master/sopir', [\App\Http\Controllers\Master\SopirController::class, 'index'])->name('sopir');
Route::get('master/sopir/blokir', [\App\Http\Controllers\Master\SopirController::class, 'indexBlokir'])->name('sopir.index-blokir');
Route::get('master/sopir/form', \App\Http\Livewire\Master\SopirForm::class)->name('sopir.form');
Route::get('master/sopir/form/{id_sopir}', \App\Http\Livewire\Master\SopirForm::class);

Route::get('transaksi/bat', [\App\Http\Controllers\Transaksi\BatController::class, 'index'])->name('bat');
Route::get('transaksi/bat/blokir', [\App\Http\Controllers\Transaksi\BatController::class, 'indexBlokir'])->name('bat.index.blokir');
Route::get('transaksi/bat/form', \App\Http\Livewire\Transaksi\BatForm::class)->name('bat.form');
Route::get('transaksi/bat/form/{id_bat}', \App\Http\Livewire\Transaksi\BatForm::class);

Route::get('transaksi/tps', [\App\Http\Controllers\Transaksi\SopirTPSController::class, 'index'])->name('tps');
Route::get('transaksi/tps/blokir', [\App\Http\Controllers\Transaksi\SopirTPSController::class, 'indexBlokir'])->name('tps.index.blokir');
Route::get('transaksi/tps/form', \App\Http\Livewire\Transaksi\SopirTpsForm::class)->name('tps.form');
Route::get('transaksi/tps/form/{id_transaksitps}', \App\Http\Livewire\Transaksi\SopirTpsForm::class);

Route::get('transaksi/lamong', [\App\Http\Controllers\Transaksi\LamongController::class, 'index'])->name('lamong');
Route::get('transaksi/lamong/blokir', [\App\Http\Controllers\Transaksi\LamongController::class, 'indexBlokir'])->name('lamong.index-blokir');
Route::get('transaksi/lamong/form', \App\Http\Livewire\Transaksi\LamongForm::class)->name('lamong.form');
Route::get('transaksi/lamong/form/{id_lamong}', \App\Http\Livewire\Transaksi\LamongForm::class);

Route::get('transaksi/stid', [\App\Http\Controllers\Transaksi\STIDController::class, 'index'])->name('stid.index');
Route::get('transaksi/stid/blokir', [\App\Http\Controllers\Transaksi\STIDController::class, 'indexBlokir'])->name('stid.index-blokir');
Route::get('transaksi/stid/form', \App\Http\Livewire\Transaksi\StidForm::class)->name('stid.form');
Route::get('transaksi/stid/form/{id_stid}', \App\Http\Livewire\Transaksi\StidForm::class);

Route::get('transaksi/mypertamina', [\App\Http\Controllers\Transaksi\MyPertaminaController::class, 'index'])->name('mypertamina.index');
Route::get('transaksi/mypertamina/blokir', [\App\Http\Controllers\Transaksi\MyPertaminaController::class, 'indexBlokir'])->name('mypertamina.index.blokir');
Route::get('transaksi/mypertamina/form', \App\Http\Livewire\Transaksi\MyPertaminaForm::class)->name('mypertamina.form');
Route::get('transaksi/mypertamina/form/{id_mypertamina}', [\App\Http\Livewire\Transaksi\MyPertaminaForm::class]);

Route::get('report/generate', [\App\Http\Controllers\Report\GenerateReport::class, 'index'])->name('report.generate');
Route::get('report/print', [\App\Http\Controllers\Report\GenerateReport::class, 'toPdf'])->name('report.print');

Route::get('report/sopir', [\App\Http\Controllers\Report\SopirReportController::class, 'index'])->name('report.sopir');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
