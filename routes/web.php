<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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
    return redirect('home');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'basket'], function () {
        Route::get('/', [BasketController::class, 'index'])->name('basket.show');
        Route::post('/set', [BasketController::class, 'set']);
        Route::post('/add', [BasketController::class, 'add']);
        Route::put('/update', [BasketController::class, 'update']);
        Route::delete('/remove', [BasketController::class, 'remove']);
    });
    Route::group(['prefix' => 'order'], function () {
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::get('/pay/{payment}', [OrderController::class, 'store'])->name('order.pay');
        Route::get('/history', [OrderController::class, 'history'])->name('order.history');
        Route::get('/{order}/details', [OrderController::class, 'details'])->name('order.details');
    });
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
});


