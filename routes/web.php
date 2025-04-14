<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/stocks', [StockController::class, 'getAllStocks'])->middleware('auth');
Route::get('/stocks/{id}', [StockController::class, 'getOrderBookByStockId'])->middleware('auth');
Route::post('/orders', [OrderController::class, 'createOrder'])->middleware('auth');
Route::get('/register', [AuthController::class, 'getRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
