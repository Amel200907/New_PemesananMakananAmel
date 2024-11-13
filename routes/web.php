<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController, MenuController, OrderController, 
    DeliveryController, RatingController, DashboardController
};
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('menu.index');
    }
    return redirect()->route('login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');

Route::middleware('auth')->group(function () {
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
    Route::post('/order', [OrderController::class, 'create'])->name('order.create');
    Route::post('/menu/{menu}/rating', [RatingController::class, 'store'])->name('rating.store');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index'); 

});
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/menu', [MenuController::class, 'store'])->name('admin.menu.store');
    Route::get('/admin/menu/{id}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');
    Route::put('/admin/menu/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
    Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    
    Route::get('/admin/orders', [AdminController::class, 'manageOrders'])->name('admin.orders');
    Route::post('/admin/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');
    Route::get('/order/{orderId}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/{orderId}/status', [OrderController::class, 'status'])->name('order.status');
});


Route::middleware('auth')->group(function () {
    Route::post('/delivery/{id}/status', [DeliveryController::class, 'updateStatus'])->name('delivery.updateStatus');
    Route::get('/delivery/{id}/chat', [DeliveryController::class, 'chat'])->name('delivery.chat');
    Route::post('/delivery/{id}/chat', [DeliveryController::class, 'sendMessage'])->name('delivery.sendMessage');
});
