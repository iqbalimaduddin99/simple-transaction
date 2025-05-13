<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Guest;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', Admin::class])->group(function (){
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::middleware(['auth', Guest::class])->group(function (){
    Route::get('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/{transaction}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
    Route::put('/transaction/{transaction}/update', [TransactionController::class, 'update'])->name('transaction.update');
    Route::delete('/transaction/{transaction}/destroy', [TransactionController::class, 'destroy'])->name('transaction.destroy');
});

Route::middleware(['auth'])->group(function (){
    Route::get("/product", [ProductController::class, 'index'])->name('product.index');
    Route::get("/transaction", [TransactionController::class, 'index'])->name('transaction.index');
    Route::get("/product/{transaction}", [ProductController::class, 'getProductByTransaction'])->name('product-transaction.index');
});

require __DIR__.'/auth.php';
