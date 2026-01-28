<?php

// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ProductController;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// Route::middleware(['web'])->group(function () {
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//     Route::apiResource('/products', ProductController::class)->middleware('auth:sanctum');
// });

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/products', ProductController::class);
});