<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Customer Information -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer Information</h3>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="customer_name" value="{{ auth()->user()->name }}" 
                                   class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="customer_email" value="{{ auth()->user()->email }}" 
                                   class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Phone <span class="text-red-500">*</span></label>
                            <input type="text" name="customer_phone" 
                                   class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Shipping Address <span class="text-red-500">*</span></label>
                            <textarea name="shipping_address" rows="3" 
                                      class="shadow border rounded w-full py-2 px-3 text-gray-700" required></textarea>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>
                        
                        <div class="space-y-3 mb-6">
                            @foreach($cart as $item)
                            <div class="flex justify-between text-sm">
                                <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                                <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t pt-4">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total:</span>
                                <span class="text-green-600">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full mt-6 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded">
                            Place Order
                        </button>

                        <a href="{{ route('cart.index') }}" class="block mt-4 text-center text-gray-500 hover:text-gray-800">
                            ← Back to Cart
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>