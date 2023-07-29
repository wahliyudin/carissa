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

Route::get('master/units', [UnitController::class, 'index'])->name('master.units.index');

Route::get('master/products', [ProductController::class, 'index'])->name('master.products.index');

Route::get('master/stocks', [StockController::class, 'index'])->name('master.stocks.index');

Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
