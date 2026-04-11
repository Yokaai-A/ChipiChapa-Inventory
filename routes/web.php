<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\User\KatalogController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\FakturController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
        if ($request->user()?->role === 'admin') {
            return redirect('/admin/products');
        }
        return redirect('/catalog');
    })->name('dashboard');

    // User Routes
    Route::get('/catalog', [KatalogController::class, 'index'])->name('catalog');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [FakturController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [FakturController::class, 'process'])->name('checkout.process');
    Route::get('/invoice/{id}', [FakturController::class, 'print'])->name('invoice.print');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', AdminProductController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
