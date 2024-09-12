<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuMakananController;
use App\Http\Controllers\MerchantOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowCustomerOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('menu-makanan', [MenuMakananController::class, 'index'])->name('menu.index');
    Route::get('menu-makanan/create', [MenuMakananController::class, 'create'])->name('menu.create');
    Route::post('menu-makanan', [MenuMakananController::class, 'store'])->name('menu.store');
    Route::get('menu-makanan/{menu}/edit', [MenuMakananController::class, 'edit'])->name('menu.edit');
    Route::patch('menu-makanan/{menu}', [MenuMakananController::class, 'update'])->name('menu.update');
    Route::delete('menu-makanan/{id}', [MenuMakananController::class, 'destroy'])->name('menu.destroy');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('search', [SearchController::class, 'index'])->name('search.index');
    Route::post('cart/{menu}/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

    Route::get('/merchant/orders', [MerchantOrderController::class, 'index'])->name('merchant.orders');
    Route::get('/order/{date}', [MerchantOrderController::class, 'showInvoiceByDate'])->name('merchant.show');

    Route::get('/customer/orders', [ShowCustomerOrderController::class, 'showCustomerOrders'])->name('customer.orders');

    // Rute untuk menampilkan invoice berdasarkan tanggal pengiriman
    Route::get('/customer/invoice/{date}', [ShowCustomerOrderController::class, 'showCustomerInvoice'])->name('customer.invoice.show');
});



require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
