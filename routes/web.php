<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPollController;
use App\Http\Controllers\Admin\PollController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/countries',[\App\Http\Controllers\CountriesController::class,'index'])->name('countries');
Route::get('/countries-search{search?}',[\App\Http\Controllers\CountriesController::class,'search'])->name('countries-search');

Route::get('/products',[\App\Http\Controllers\ProductsController::class,'index'])->name('products');
Route::post('/products-add',[\App\Http\Controllers\ProductsController::class,'add'])->name('addprod');
Route::get('/products-del/{product?}',[\App\Http\Controllers\ProductsController::class,'delete'])->name('delprod');
Route::get('/products-search/{search?}',[\App\Http\Controllers\ProductsController::class,'search'])->name('products-search');
Route::get('/products/edit/{product?}}',[\App\Http\Controllers\ProductsController::class,'edit'])->name('products-edit');
Route::post('/products/update/{product}',[\App\Http\Controllers\ProductsController::class,'update'])->name('products-update');
Route::get('/products/show/{product?}}',[\App\Http\Controllers\ProductsController::class,'show'])->name('products-show');


Route::get('/category',[\App\Http\Controllers\CategoryController::class,'index'])->name('category');
Route::get('/category/create',[\App\Http\Controllers\CategoryController::class,'create'])->name('category-create');
Route::post('/category/store',[\App\Http\Controllers\CategoryController::class,'store'])->name('category-store');
Route::get('/category/edit/{category}}',[\App\Http\Controllers\CategoryController::class,'edit'])->name('category-edit');
Route::post('/category/update/{category}',[\App\Http\Controllers\CategoryController::class,'update'])->name('category-update');
Route::post('/category/delete/{category}',[\App\Http\Controllers\CategoryController::class,'delete'])->name('category-delete');
Route::get('/category/show/{category}}',[\App\Http\Controllers\CategoryController::class,'show'])->name('category-show');

Route::prefix('poll')->as('poll.')->group(function () {
    Route::get('/', [PollController::class, 'index'])
         ->name('index');
     Route::get('/polls', [PublicPollController::class, 'index'])
         ->name('public-index');
    Route::get('/{poll}/show', [PublicPollController::class, 'show'])
         ->name('show');
     Route::get('/{poll}/data', [PublicPollController::class, 'data'])
         ->name('data');
     Route::get('/data/{poll}', [PublicPollController::class, 'getAnswersData'])
         ->name('get-answers');
     Route::post('/create-answer', [PublicPollController::class, 'createAnswer'])
         ->name('create-answer');
    Route::get('/create', [PollController::class, 'create'])
         ->name('create');
    Route::post('/store', [PollController::class, 'store'])
         ->name('store');
    Route::get('/{poll}/edit', [PollController::class, 'edit'])
         ->name('edit');
    Route::post('/{poll}/update', [PollController::class, 'update'])
         ->name('update');
     Route::post('/update-variant/{poll}/{variant}', [PollController::class, 'updateVariant'])
         ->name('update-variant');
    Route::post('/destroy/{poll}', [PollController::class, 'destroy'])
         ->name('destroy');
    Route::post('/destroy-variant/{poll}/{variant}', [PollController::class, 'destroyVariant'])
         ->name('destroy-variant');
    Route::post('/variant-store/{poll}', [PollController::class, 'storeVariant'])
         ->name('store-variant');
});



Route::get('/pay/{product}',[\App\Http\Controllers\PayController::class,'index'])->name('pay');
Route::get('/pay-request/{product}',[\App\Http\Controllers\PayController::class,'paymentRequest'])->name('pay-request');
Route::get('/pay-donate-request/{donate}',[\App\Http\Controllers\PayController::class,'requestPaymentDonate'])->name('pay-donate-request');
Route::post('/pay-result/{quantity}/{product}',[\App\Http\Controllers\PayController::class,'paymentResult'])->name('pay-result');
Route::post('/pay-result/{donate}',[\App\Http\Controllers\PayController::class,'resultPaymentDonate'])->name('pay-donate-result');

Route::get('/donate',[\App\Http\Controllers\DonateController::class,'index'])->name('donate');
Route::get('/donate-pay/{donate}',[\App\Http\Controllers\DonateController::class,'donate'])->name('donate-pay');
Route::get('/donate-create',[\App\Http\Controllers\Admin\DonateController::class,'create'])->name('donate-create');
Route::post('/donate-store',[\App\Http\Controllers\Admin\DonateController::class,'store'])->name('donate-store');
Route::get('/donate-edit/{donate}',[\App\Http\Controllers\Admin\DonateController::class,'edit'])->name('donate-edit');
Route::post('/donate-update/{donate}',[\App\Http\Controllers\Admin\DonateController::class,'update'])->name('donate-update');
Route::post('/donate-destroy/{donate}',[\App\Http\Controllers\Admin\DonateController::class,'destroy'])->name('donate-destroy');
Route::get('/donate-show/{donate}',[\App\Http\Controllers\Admin\DonateController::class,'show'])->name('donate-show');
