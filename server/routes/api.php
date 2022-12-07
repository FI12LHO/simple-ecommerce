<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;

Route::controller(UserController::class, function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/', 'login');
        Route::post('/register', 'register');
        Route::get('/me', 'me');
    });
});

Route::controller(ProductController::class, function () {
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'index');
        Route::post('/create', 'create');
        Route::put('/update/{id}', 'update');
        Route::delete('/delete/{id}', 'destroy');
    });
});

Route::controller(SaleController::class, function () {
    Route::post('/sale', 'create');
});

Route::controller(PurchaseController::class, function () {
    Route::post('/purchase', 'create');
});