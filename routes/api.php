<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Вход
Route::post('/login', [UserController::class, 'login'])->name('login');

// Продукты
Route::get('/products', [ProductController::class, 'index']);


Route::middleware('auth:sanctum')->group(function(){
    // Пользователь
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/add_to_balance', [UserController::class, 'addToBalance']);

    // Управление корзиной
    Route::resource('/baskets', BasketController::class);

    // Управление заказами
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'createOrder']);
    Route::post('/orders/{order}', [OrderController::class, 'cancelOrder']);
});