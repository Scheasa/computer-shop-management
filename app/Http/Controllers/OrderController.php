<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Admin: View All Orders
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
                       ->latest()
                       ->paginate(15);
        return view('orders.index', compact('orders'));
    }

    // Admin: View Single Order
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('orders.show', compact('order'));
    }

    // Admin: Update Order Status
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        // If cancelling, restore stock
        if ($request->status === 'cancelled' && $order->status !== 'cancelled') {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
        }

        $order->update(['status' => $request->status]);

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Order status updated to ' . $request->status);
    }

    // Admin: Delete Order
    public function destroy(Order $order)
    {
        // Restore stock if not already cancelled
        if ($order->status !== 'cancelled') {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
        }

        $order->delete();

        return redirect()->route('orders.index')
                         ->with('success', 'Order deleted successfully.');
    }

    // Admin: Create Order (Manual Order Entry for Staff)
    public function create()
{
    $products = Product::where('stock', '>', 0)
                      ->where('is_visible', true)
                      ->with(['category', 'brand'])
                      ->get();
    return view('orders.create', compact('products'));
}

public function store(Request $request)
{
    $request->validate([
        'user_id' => 'nullable|exists:users,id',
        'status' => 'required|in:pending,processing,completed,cancelled',
        'items' => 'required|array|min:1',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
    ]);

    DB::beginTransaction();
    try {
        $totalAmount = 0;
        $orderItems = [];

        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            
            if ($product->stock < $item['quantity']) {
                throw new \Exception("Insufficient stock for {$product->name}");
            }

            $subtotal = $product->price * $item['quantity'];
            $totalAmount += $subtotal;

            $orderItems[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $item['quantity'],
            ];

            $product->decrement('stock', $item['quantity']);
        }

        $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

        $order = Order::create([
            'user_id' => $request->user_id,
            'order_number' => $orderNumber,
            'status' => $request->status,
            'total_amount' => $totalAmount,
        ]);

        foreach ($orderItems as $item) {
            $order->items()->create($item);
        }

        DB::commit();

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Order created. Number: ' . $orderNumber);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                            ->with('error', 'Failed: ' . $e->getMessage());
        }
    }

    // Add these methods to your existing OrderController

// Customer: View My Orders
    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())
                    ->with('items')
                    ->latest()
                    ->paginate(10);
        return view('orders.my-orders', compact('orders'));
    }

    // Customer: View Single Order
    public function myOrderShow(Order $order)
    {
        // Ensure customer can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items');
        return view('orders.my-order-show', compact('order'));
    }
}   