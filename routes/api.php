<?php
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\AiController;
use Illuminate\Support\Facades\Route;

Route::post('/predict', [AiController::class, 'predict']);
Route::post('/ai/recommend', [AiController::class, 'recommend']);
// Home
Route::get('/', [RestaurantController::class, 'index'])->name('home');

// Restaurants
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{slug}', [RestaurantController::class, 'show'])->name('restaurants.show');

// Protected routes (must be logged in)
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

// Auth (login, register, logout)
Auth::routes();
