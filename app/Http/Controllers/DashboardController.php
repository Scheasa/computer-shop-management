<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic Counts (PDF Schema)
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBrands = Brand::count();
        $totalOrders = Order::count();

        // Revenue
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $pendingRevenue = Order::where('status', 'pending')->sum('total_amount');

        // Recent Orders
        $recentOrders = Order::with(['user', 'items'])->latest()->take(5)->get();

        // Low Stock
        $lowStockProducts = Product::where('stock', '<', 10)->where('is_visible', true)->take(5)->get();

        // Chart Data
        $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))->groupBy('status')->get();
        
        return view('dashboard', compact(
            'totalProducts', 'totalCategories', 'totalBrands', 'totalOrders',
            'totalRevenue', 'pendingRevenue', 'recentOrders', 'lowStockProducts', 'ordersByStatus'
        ));
    }
}