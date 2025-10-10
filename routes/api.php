<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

    Route::post('/store', [ProductController::class, 'store'])->middleware('auth:sanctum');

    Route::put('/{id}', [ProductController::class, 'update'])->middleware('auth:sanctum');

    Route::delete('/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');

    Route::get('/get', [ProductController::class, 'index']);

});