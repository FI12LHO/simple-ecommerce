<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/',[UserController::class, 'login']);
    Route::post('/register',[UserController::class, 'register']);
});

Route::group(['prefix' => 'product', 'middleware' => 'token.access'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/create', [ProductController::class, 'create']);
    Route::put('/update/{id}', [ProductController::class, 'update']);
    Route::delete('/delete/{id}', [ProductController::class, 'destroy']);
});

Route::group(['middleware' => 'token.access'], function () {
    Route::post('/sale', [SaleController::class, 'create']);
    Route::get('/me',[UserController::class, 'me']);
});