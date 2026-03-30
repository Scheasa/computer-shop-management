<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Welcome/Home Page (Public)
Route::get('/', function () {
    // Get data from database
    $categories = Category::whereNull('parent_id')->take(4)->get();
    $brands = Brand::take(6)->get();
    $products = Product::where('is_visible', true)
                       ->with(['category', 'brand'])
                       ->take(8)
                       ->get();
    
    return view('Main', compact('categories', 'brands', 'products'));
})->name('home');

// Cart Routes (Auth Required)
// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    Route::get('/products/brand/{brand}', [ProductController::class, 'byBrand'])->name('products.byBrand');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resources (CRUD)
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Order History
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::get('/my-orders/{order}', [OrderController::class, 'myOrderShow'])->name('orders.my.show');
});

// Admin Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
});

// Customer Routes (Public)
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/shop/{product}', [ProductController::class, 'shopShow'])->name('shop.show');

// require __DIR__.'/auth.php';