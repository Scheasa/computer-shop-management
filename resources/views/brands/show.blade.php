<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Brand Details') }}
            </h2>
            <div class="mt-2 md:mt-0 flex gap-2">
                <a href="{{ route('brands.edit', $brand->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded text-sm">
                    Edit
                </a>
                <a href="{{ route('brands.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Brand Header -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-start gap-6">
                        <!-- Brand Logo -->
                        <div class="w-48 h-48 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            @if($brand->image)
                                <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="w-full h-full object-contain p-4">
                            @else
                                <span class="text-4xl font-bold text-gray-400">{{ substr($brand->name, 0, 2) }}</span>
                            @endif
                        </div>

                        <!-- Brand Info -->
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $brand->name }}</h1>
                            <p class="text-gray-500 font-mono text-sm mb-4">Slug: {{ $brand->slug }}</p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">Total Products</p>
                                    <p class="font-bold text-2xl text-blue-600">{{ $brand->products->count() }}</p>
                                </div>
                                <div class="bg-green-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">In Stock</p>
                                    <p class="font-bold text-2xl text-green-600">{{ $brand->products->where('stock', '>', 0)->count() }}</p>
                                </div>
                                <div class="bg-purple-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">Categories</p>
                                    <p class="font-bold text-2xl text-purple-600">{{ $brand->products->pluck('category_id')->unique()->count() }}</p>
                                </div>
                                <div class="bg-yellow-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">Created</p>
                                    <p class="font-bold text-lg text-yellow-600">{{ $brand->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>

                            <!-- View All Products Button -->
                            @if($brand->products->count() > 0)
                                <a href="{{ route('products.byBrand', $brand->id) }}" 
                                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                                    <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    View All {{ $brand->name }} Products ({{ $brand->products->count() }})
                                </a>
                            @else
                                <p class="text-gray-500 italic">No products available for this brand yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Products from This Brand (Preview) -->
            @if($brand->products->count() > 0)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">Featured Products from {{ $brand->name }}</h3>
                        <a href="{{ route('products.byBrand', $brand->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            View All →
                        </a>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($brand->products->take(4) as $product)
                        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                            <div class="h-48 bg-gray-100 flex items-center justify-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                            </div>
                            <div class="p-4">
                                <h4 class="font-semibold text-gray-800 mb-1 truncate">{{ $product->name }}</h4>
                                <p class="text-sm text-gray-500 mb-2">{{ $product->sku }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-xs {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>