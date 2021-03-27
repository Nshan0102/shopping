<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\HomeController;
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

Route::group(['middleware' => 'auth'], function (){
    Route::group(['prefix' => 'basket'], function (){
        Route::get('/', [BasketController::class, 'index'])->name('basket.show');
    });
});


