<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product Details') }}
            </h2>
            <div class="mt-2 md:mt-0 flex gap-2">
                <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded text-sm">
                    Edit
                </a>
                <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                <!-- Product Header -->
                <div class="p-6 border-b">
                    <div class="flex items-start gap-6">
                        <!-- Product Image -->
                        <div class="w-48 h-48 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg">
                            @else
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                            <p class="text-gray-500 font-mono text-sm mb-4">SKU: {{ $product->sku }}</p>
                            
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-sm text-gray-500">Category</p>
                                    <p class="font-medium">{{ $product->category->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Brand</p>
                                    <p class="font-medium">{{ $product->brand?->name ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Price</p>
                                    <p class="font-medium text-blue-600 text-lg">${{ number_format($product->price, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Stock</p>
                                    <p class="font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $product->stock }} units</p>
                                </div>
                            </div>

                            <span class="inline-block px-3 py-1 text-sm rounded {{ $product->is_visible ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $product->is_visible ? 'Visible' : 'Hidden' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Product Attributes -->
                @if($product->attributes->count() > 0)
                <div class="p-6 border-b">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Specifications</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($product->attributes as $attr)
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-500">{{ $attr->name }}</span>
                            <span class="font-medium text-gray-900">{{ $attr->value }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Timestamps -->
                <div class="p-6 bg-gray-50">
                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-500">
                        <div>Created: {{ $product->created_at->format('M d, Y h:i A') }}</div>
                        <div>Updated: {{ $product->updated_at->format('M d, Y h:i A') }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>