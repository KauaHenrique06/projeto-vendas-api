<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function() {

    Route::post('/register', [AuthController::class, 'index']);

    Route::post('/login', [AuthController::class, 'login']);

});

Route::prefix('product')->group(function() {

    Route::post('/register', [ProductController::class, 'register']);

    Route::put('/update/{id}', [ProductController::class, 'update']);

    Route::delete('/delete/{id}', [ProductController::class, 'destroy']);

    Route::get('/get', [ProductController::class, 'show']);

});