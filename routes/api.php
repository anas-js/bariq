<?php

use App\Http\Controllers\AdminController;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::get('/user',[AdminController::class,'user'])->middleware('auth');

Route::post('/login',[AdminController::class,'login'])->middleware('guest');
