<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
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
});
