<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UsersController::class)->group(function () {
    Route::get('users', 'index');
    Route::get('/users/{id}', 'show');
    Route::get('/users/code{code}', 'code');
    Route::post('/users', 'store');
});



Route::controller(OrdersController::class)->group(function () {
    Route::get('/orders', 'index');
    Route::get('/orders/{id}', 'show');
    Route::get('/orders/code/{code}', 'code');
    Route::post('/orders', 'store');
    Route::put('/orders/{id}', 'App\Http\Controllers\OrdersController@update');
    Route::delete('/orders/{id}', 'App\Http\Controllers\OrdersController@destroy');
    Route::get('/orders/where/{is_delivered_by}' ,'showOrderByRole');
});