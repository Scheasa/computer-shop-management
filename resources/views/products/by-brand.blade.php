<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Products from') }} {{ $brand->name }}
            </h2>
            <a href="{{ route('brands.show', $brand->id) }}" class="mt-2 md:mt-0 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                ← Back to Brand
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Breadcrumb -->
            <div class="mb-6 text-sm text-gray-500">
                <a href="{{ url('/dashboard') }}" class="hover:text-gray-700">Dashboard</a> 
                <span class="mx-2">/</span>
                <a href="{{ route('brands.index') }}" class="hover:text-gray-700">Brands</a>
                <span class="mx-2">/</span>
                <a href="{{ route('brands.show', $brand->id) }}" class="hover:text-gray-700">{{ $brand->name }}</a>
                <span class="mx-2">/</span>
                <span class="font-semibold text-gray-800">All Products</span>
            </div>

            <!-- Brand Info Banner -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        @if($brand->image)
                            <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="w-16 h-16 object-contain">
                        @endif
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $brand->name }} Products</h1>
                            <p class="text-gray-500">{{ $products->total() }} products found</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse($products as $product)
                        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                            <a href="{{ route('products.show', $product->id) }}" class="block">
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
                                    <p class="text-xs text-gray-400 mb-2">{{ $product->category->name }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                                        <span class="text-xs {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p class="mt-4 text-gray-500 text-lg">No products found for this brand.</p>
                            <a href="{{ route('products.create') }}" class="mt-4 inline-block text-blue-500 hover:text-blue-700">Add a product →</a>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($products->hasPages())
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>