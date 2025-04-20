<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ListController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Salesperson\SaleController;
use App\Http\Controllers\Salesperson\SoldController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource("users", UserController::class);
Route::resource("cars", CarController::class);
Route::resource("roles", RoleController::class);
Route::resource("lists", ListController::class);
Route::resource("services", ServiceController::class);

Route::resource("sales", SaleController::class);
Route::resource("solds", SoldController::class);
