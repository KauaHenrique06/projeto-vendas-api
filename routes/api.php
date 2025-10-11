<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function() {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

});

Route::prefix('product')->group(function() {

    Route::get('/get', [ProductController::class, 'index']);

    Route::post('/store', [ProductController::class, 'store'])->middleware('auth:sanctum');

    Route::put('/{id}', [ProductController::class, 'update'])->middleware('auth:sanctum');

    Route::delete('/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');

    Route::put('/quantity/{id}', [ProductController::class, 'updateQuantity'])->middleware('auth:sanctum');

});

Route::prefix('sale')->group(function() {

    Route::get('/get', [SaleController::class, 'index'])->middleware("auth:sanctum");

    Route::post('/store', [SaleController::class, 'store'])->middleware('auth:sanctum');

    Route::get('/{id}', [SaleController::class, 'show'])->middleware('auth:sanctum');

    Route::delete('/{id}', [SaleController::class, 'destroy'])->middleware('auth:sanctum');

});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/orders', [OrderController::class, 'store']);

    Route::post('/orders/{order}/accept', [OrderController::class, 'accept'])->middleware('auth:sanctum');

    Route::post('/orders/{order}/deny', [OrderController::class, 'deny'])->middleware('auth:sanctum');
    
});