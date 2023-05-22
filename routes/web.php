<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/countries',[\App\Http\Controllers\CountriesController::class,'index'])->name('countries');
Route::get('/countries-search{search?}',[\App\Http\Controllers\CountriesController::class,'search'])->name('countries-search');
Route::get('/products',[\App\Http\Controllers\ProductsController::class,'index'])->name('products');
Route::get('/products-add',[\App\Http\Controllers\ProductsController::class,'addProd'])->name('addprod');
Route::get('/products-del',[\App\Http\Controllers\ProductsController::class,'delProd'])->name('delprod');
Route::get('/products-search{search?}',[\App\Http\Controllers\ProductsController::class,'search'])->name('products-search');