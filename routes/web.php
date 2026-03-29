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

    
});

// require __DIR__.'/auth.php';