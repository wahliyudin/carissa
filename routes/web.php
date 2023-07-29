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
Route::post('master/products/datatable', [ProductController::class, 'datatable'])->name('master.products.datatable');
Route::post('master/products/store', [ProductController::class, 'store'])->name('master.products.store');
Route::get('master/products/{product}/edit', [ProductController::class, 'edit'])->name('master.products.edit');
Route::delete('master/products/{product}/destroy', [ProductController::class, 'destroy'])->name('master.products.destroy');

Route::get('master/stocks', [StockController::class, 'index'])->name('master.stocks.index');
Route::post('master/stocks/datatable', [StockController::class, 'datatable'])->name('master.stocks.datatable');
Route::post('master/stocks/store', [StockController::class, 'store'])->name('master.stocks.store');
Route::get('master/stocks/{stock}/edit', [StockController::class, 'edit'])->name('master.stocks.edit');
Route::delete('master/stocks/{stock}/destroy', [StockController::class, 'destroy'])->name('master.stocks.destroy');

Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::post('purchases/datatable', [PurchaseController::class, 'datatable'])->name('purchases.datatable');
Route::post('purchases/store', [PurchaseController::class, 'store'])->name('purchases.store');
Route::get('purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
Route::delete('purchases/{purchase}/destroy', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
