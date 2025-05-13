<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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


Route::get("/product", [ProductController::class, 'index'])->middleware(['auth'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->middleware(['auth'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->middleware(['auth'])->name('product.store');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->middleware(['auth'])->name('product.edit');
Route::put('/product/{product}/update', [ProductController::class, 'update'])->middleware(['auth'])->name('product.update');
Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->middleware(['auth'])->name('product.destroy');

require __DIR__.'/auth.php';
