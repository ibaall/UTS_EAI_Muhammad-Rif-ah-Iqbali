<?php
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::post('/products', [ProductController::class, 'store']);
Route::patch('/products/{id}/stock', [ProductController::class, 'updateStock']);
