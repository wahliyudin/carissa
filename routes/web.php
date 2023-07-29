<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('master/suppliers', [SupplierController::class, 'index'])->name('master.suppliers.index');
Route::post('master/suppliers/datatable', [SupplierController::class, 'datatable'])->name('master.suppliers.datatable');
Route::post('master/suppliers/store', [SupplierController::class, 'store'])->name('master.suppliers.store');
Route::get('master/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('master.suppliers.edit');
Route::delete('master/suppliers/{supplier}/destroy', [SupplierController::class, 'destroy'])->name('master.suppliers.destroy');

Route::get('master/units', [UnitController::class, 'index'])->name('master.units.index');
Route::post('master/units/datatable', [UnitController::class, 'datatable'])->name('master.units.datatable');
Route::post('master/units/store', [UnitController::class, 'store'])->name('master.units.store');
Route::get('master/units/{unit}/edit', [UnitController::class, 'edit'])->name('master.units.edit');
Route::delete('master/units/{unit}/destroy', [UnitController::class, 'destroy'])->name('master.units.destroy');

Route::get('master/products', [ProductController::class, 'index'])->name('master.products.index');

Route::get('master/stocks', [StockController::class, 'index'])->name('master.stocks.index');

Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
