<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order Details') }} - {{ $order->order_number }}
            </h2>
            <a href="{{ route('orders.index') }}" class="mt-2 md:mt-0 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                ← Back to Orders
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Order Info Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Order Number</p>
                            <p class="font-mono font-bold text-gray-900">{{ $order->order_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Customer</p>
                            <p class="font-medium text-gray-900">{{ $order->user?->name ?? 'Guest' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Amount</p>
                            <p class="font-bold text-green-600 text-lg">${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Order Date</p>
                            <p class="font-medium text-gray-900">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>

                    <!-- Update Status Form -->
                    <form action="{{ route('orders.update', $order->id) }}" method="POST" class="border-t pt-4">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center gap-4">
                            <label class="text-sm font-medium text-gray-700">Update Status:</label>
                            <select name="status" class="border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-blue-500">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-800">Order Items</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->items as $item)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $item->name }}
                                @if($item->product)
                                    <a href="{{ route('products.show', $item->product->id) }}" class="text-blue-600 hover:text-blue-800 text-xs ml-2">(View)</a>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">${{ number_format($item->price, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-bold">Total:</td>
                            <td class="px-6 py-4 font-bold text-lg text-green-600">
                                ${{ number_format($order->total_amount, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Delete Order -->
            <div class="mt-6">
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" 
                      onsubmit="return confirm('Are you sure? This will restore stock for all items.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                        Delete Order
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>