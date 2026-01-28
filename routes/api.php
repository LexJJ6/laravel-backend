<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Autenticação
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Produtos
// Route::get('/products', [ProductController::class, 'index'])->middleware('optional_auth');
// Route::post('/products', [ProductController::class, 'store'])->middleware('auth:sanctum');
// Route::get('/products/{id}', [ProductController::class, 'show'])->middleware('optional_auth');
// Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('auth:sanctum');
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');
Route::apiResource('/products', ProductController::class)->middleware('auth:sanctum');