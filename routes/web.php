<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController, MenuController, OrderController, 
    DeliveryController, RatingController, DashboardController,
    LoginController, RegisterController
};
Route::get('/dashboard', function () {
    if (auth()->check()) {
        return auth()->user()->is_admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('menu.index');
    }
    return redirect()->route('login');
})->name('dashboard');

// Public Routes (menu bisa dilihat tanpa login)
Route::get('/', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');


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
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
});
Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::post('/menu/{menuId}/favorite', [MenuController::class, 'favorite'])->name('menu.favorite');
Route::delete('/menu/{menuId}/unfavorite', [MenuController::class, 'unfavorite'])->name('menu.unfavorite');

Route::get('/admin/orders', [AdminController::class, 'manageOrders'])->name('admin.orders');
Route::post('/admin/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');
Route::delete('/admin/orders/{id}', [AdminController::class, 'deleteOrder'])->name('admin.order.delete');
Route::middleware('auth')->prefix('delivery')->name('delivery.')->group(function () {
    Route::get('/orders', [DeliveryController::class, 'orders'])->name('orders');
    Route::post('/orders/{id}/status', [DeliveryController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/menu/{menu}/rating', [MenuController::class, 'storeRating'])->name('rating.store');

});
