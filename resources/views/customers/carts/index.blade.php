<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(count($cart) > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($cart as $id => $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-12 h-12 object-cover rounded mr-4">
                                        @endif
                                        <span class="font-medium">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">${{ number_format($item['price'], 2) }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['stock'] }}" class="w-16 border rounded px-2 py-1">
                                        <button type="submit" class="ml-2 text-blue-600 hover:text-blue-800">Update</button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 font-bold">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right font-bold">Total:</td>
                                <td class="px-6 py-4 font-bold text-xl">${{ number_format($total, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="p-6 flex justify-between">
                        <a href="{{ route('shop') }}" class="text-blue-600 hover:text-blue-800">← Continue Shopping</a>
                        <div class="flex gap-4">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Clear Cart</button>
                            </form>
                            <a href="{{ route('checkout.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                                Proceed to Checkout →
                            </a>
                        </div>
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <p class="mt-4 text-gray-500 text-lg">Your cart is empty.</p>
                        <a href="{{ route('shop') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">Start Shopping →</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>