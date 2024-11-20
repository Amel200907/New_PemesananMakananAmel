<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController, MenuController, OrderController, 
    DeliveryController, RatingController, DashboardController,
    LoginController, RegisterController
};

// Dashboard Redirection
Route::get('/dashboard', function () {
    if (auth()->check()) {
        return auth()->user()->is_admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('menu.index');
    }
    return redirect()->route('login');
})->name('dashboard');

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');

// Public Routes
Route::get('/', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Order Routes
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
    Route::post('/order', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/{orderId}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/{orderId}/status', [OrderController::class, 'status'])->name('order.status');

    // Rating Routes
    Route::post('/menu/{menu}/rating', [RatingController::class, 'store'])->name('rating.store');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Menu Management
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

    // Orders Management
    Route::get('/orders', [AdminController::class, 'manageOrders'])->name('orders');
    Route::post('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('order.updateStatus');
});

// Delivery Routes
Route::middleware('auth')->prefix('delivery')->name('delivery.')->group(function () {
    Route::post('/{id}/status', [DeliveryController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/{id}/chat', [DeliveryController::class, 'chat'])->name('chat');
    Route::post('/{id}/chat', [DeliveryController::class, 'sendMessage'])->name('sendMessage');
});
