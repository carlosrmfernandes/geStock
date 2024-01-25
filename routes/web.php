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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::post('/product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
Route::post('/product-delete/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete');

Route::get('/debt', [App\Http\Controllers\DebtController::class, 'index'])->name('debt');
Route::post('/debt', [App\Http\Controllers\DebtController::class, 'store'])->name('debt.store');
Route::get('/debt/{id}', [App\Http\Controllers\DebtController::class, 'show'])->name('debt.show');
Route::post('/debt-delete/{id}', [App\Http\Controllers\DebtController::class, 'delete'])->name('debt.delete');


Route::get('/stock', [App\Http\Controllers\StockController::class, 'index'])->name('stock');
Route::post('/stock', [App\Http\Controllers\StockController::class, 'store'])->name('stock.store');
Route::get('/stock/{id}', [App\Http\Controllers\StockController::class, 'show'])->name('stock.show');
Route::post('/stock-delete', [App\Http\Controllers\StockController::class, 'delete'])->name('stock.delete');
