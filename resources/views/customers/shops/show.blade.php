<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
                    
                    <!-- Product Image -->
                    <div>
                        <div class="bg-gray-100 rounded-lg h-96 flex items-center justify-center">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain">
                            @else
                                <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            @endif
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                        <p class="text-gray-500 mb-4">SKU: {{ $product->sku }}</p>
                        
                        <div class="mb-4">
                            <span class="text-3xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                            @if($product->stock > 0)
                                <span class="ml-4 text-green-600 font-medium">✓ In Stock ({{ $product->stock }} available)</span>
                            @else
                                <span class="ml-4 text-red-600 font-medium">✗ Out of Stock</span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Category: <span class="font-medium text-gray-900">{{ $product->category->name }}</span></p>
                            <p class="text-sm text-gray-500">Brand: <span class="font-medium text-gray-900">{{ $product->brand?->name ?? 'N/A' }}</span></p>
                        </div>

                        <!-- Specifications -->
                        @if($product->attributes->count() > 0)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Specifications</h3>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($product->attributes as $attr)
                                <div class="flex justify-between py-2 border-b">
                                    <span class="text-gray-500">{{ $attr->name }}</span>
                                    <span class="font-medium text-gray-900">{{ $attr->value }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Add to Cart Form -->
                        @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="flex gap-4">
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                       class="shadow border rounded w-20 py-2 px-3 text-gray-700 text-center">
                                <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded">
                                    Add to Cart
                                </button>
                            </div>
                        </form>
                        @else
                        <button disabled class="w-full bg-gray-400 text-white font-bold py-3 px-6 rounded cursor-not-allowed">
                            Out of Stock
                        </button>
                        @endif

                        <a href="{{ route('shop') }}" class="text-blue-600 hover:text-blue-800">← Back to Shop</a>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
            <div class="mt-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Related Products</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <a href="{{ route('shop.show', $related->id) }}" class="block">
                            <div class="h-40 bg-gray-200 flex items-center justify-center">
                                @if($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                            </div>
                            <div class="p-3">
                                <h4 class="font-semibold text-gray-800 mb-1 truncate">{{ $related->name }}</h4>
                                <p class="text-blue-600 font-bold">${{ number_format($related->price, 2) }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>