<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/',[UserController::class, 'login']);
    Route::post('/register',[UserController::class, 'register']);
    Route::get('/me',[UserController::class, 'me']);
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/create', [ProductController::class, 'create']);
    Route::put('/update/{id}', [ProductController::class, 'update']);
    Route::delete('/delete/{id}', [ProductController::class, 'destroy']);
});

Route::post('/sale', [SaleController::class, 'create']);

Route::post('/purchase', [PurchaseController::class, 'create']);