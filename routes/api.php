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
    Route::get('/users/code/{code}', 'code');
    Route::post('/users', 'store');
    Route::delete('/users/{user_id}', 'delete_user_id');
    Route::get('/users/role/{role}', 'role');
    Route::get('/users/user-role/{email}', 'getUserRoleByEmail');
    Route::put('/users/up/{id}', 'update');
    Route::put('/users/up-email/{id}', 'updateEmail');

});



Route::controller(OrdersController::class)->group(function () {
    Route::get('/orders', 'index');
    Route::get('/orders/{id}', 'show');
    Route::put('/orders/status/{id}', 'statusUpdate');
    Route::get('/orders/code/{code}', 'code');
    Route::post('/orders', 'store');
    Route::put('/orders/update/{id}', 'App\Http\Controllers\OrdersController@update');
    Route::delete('/orders/{id}', 'App\Http\Controllers\OrdersController@destroy');

    Route::get('/orders/where/{is_delivered_by}', 'showOrderByRole');
    Route::get('/orders/paid/{is_delivered_by}', 'getPaidAndDeliveredData');
    Route::get('/orders/paid/client/{user_id}', 'getPaidAndDeliveredDataClient');
    Route::get('/orders/noPaid/{is_delivered_by}', 'getNoPaidAndDeliveredData');
    Route::get('/orders/noPaid/client/{user_id}', 'getNoPaidAndDeliveredDataClient');

});