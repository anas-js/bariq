<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\itemsController;
use App\Http\Controllers\OrdersController;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::get('/user',[AdminController::class,'user'])->middleware('auth');

Route::post('/login',[AdminController::class,'login'])->middleware('guest');



Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/income',[DashboardController::class,'income']);
    Route::get('/orders',[DashboardController::class,'orders']);
    Route::get('/customers',[DashboardController::class,'customers']);
    Route::get('/activity-time',[DashboardController::class,'activityTime']);
    Route::get('/execution-average-time',[DashboardController::class,'executionAverageTime']);
    Route::get('/delivery-average-time',[DashboardController::class,'deliveryAverageTime']);
    Route::get('/most-services-order',[DashboardController::class,'mostServicesOrder']);
    Route::get('/last-orders',[DashboardController::class,'lastOrders']);
});

Route::prefix('orders')->middleware('auth')->group(function () {
    Route::post('/create',[OrdersController::class,'create']);
    Route::get('/all',[OrdersController::class,'allOrders']);
    Route::get('/{id}',[OrdersController::class,'get']);
});


// Route::get('/items',[itemsController::class,'get']);


Route::prefix('/items')->middleware('auth')->group(function () {
    Route::get('/',[itemsController::class,'get']);

    Route::get('/{id}',[itemsController::class,'services']);
});


Route::prefix('/customers')->middleware('auth')->group(function () {
    Route::get('/',[CustomerController::class,'get']);

});
