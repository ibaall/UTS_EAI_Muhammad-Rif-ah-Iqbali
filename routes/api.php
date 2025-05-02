<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'createOrder']);
Route::get('/users/{user_id}/orders', [OrderController::class, 'history']);
Route::get('/orders/{id}/history', [OrderController::class, 'orderHistory']);
