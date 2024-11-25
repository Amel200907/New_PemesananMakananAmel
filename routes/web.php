<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController, MenuController, OrderController, 
    DeliveryController, RatingController, DashboardController,
    LoginController, RegisterController
};
// Public Routes (menu bisa dilihat tanpa login)
Route::get('/', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');


// Authenticated Routes (hanya bisa checkout setelah login)
Route::middleware('auth')->group(function () {
    // Order Routes (checkout, riwayat pesanan)
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
});
// Admin Routes
Route::get('/admin/orders', [AdminController::class, 'manageOrders'])->name('admin.orders');
Route::post('/admin/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');
Route::delete('/admin/orders/{id}', [AdminController::class, 'deleteOrder'])->name('admin.order.delete');
Route::middleware('auth')->prefix('delivery')->name('delivery.')->group(function () {
    Route::get('/orders', [DeliveryController::class, 'orders'])->name('orders');
    Route::post('/orders/{id}/status', [DeliveryController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/menu/{menu}/rating', [MenuController::class, 'storeRating'])->name('rating.store');

});