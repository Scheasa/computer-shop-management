<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Brands') }}
            </h2>
            <a href="{{ route('brands.create') }}" class="mt-2 md:mt-0 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                + Add New Brand
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Breadcrumb -->
            <div class="mb-6 text-sm text-gray-500">
                <a href="{{ url('/dashboard') }}" class="hover:text-gray-700">Dashboard</a> 
                <span class="mx-2">/</span> 
                <span class="font-semibold text-gray-800">All Brands</span>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search & Filter (Optional) -->
            <div class="mb-6 flex gap-4">
                <input type="text" id="searchBrand" placeholder="Search brands..." 
                       class="shadow border rounded w-full md:w-64 py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
            </div>

            <!-- Brands Grid Layout -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                
                @forelse($brands as $brand)
                    <div class="group relative" data-brand-name="{{ strtolower($brand->name) }}">
                        
                        <!-- Clickable Card (Links to Show Page) -->
                        <a href="{{ route('brands.show', $brand->id) }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg h-40 flex items-center justify-center p-4 hover:shadow-lg hover:border-blue-500 transition duration-300">
                                
                                @if($brand->image)
                                    <img src="{{ asset('storage/' . $brand->image) }}" 
                                        alt="{{ $brand->name }}" 
                                        class="max-h-24 max-w-full object-contain group-hover:scale-105 transition duration-300">
                                @else
                                    <span class="text-gray-700 font-medium text-lg text-center">
                                        {{ $brand->name }}
                                    </span>
                                @endif

                            </div>
                            
                            <!-- Brand Name Below Card -->
                            <p class="text-center text-sm text-gray-600 mt-2 font-medium truncate">
                                {{ $brand->name }}
                            </p>
                        </a>

                        <!-- Action Buttons (Outside the link - Show on Hover) -->
                        <div class="flex justify-center gap-2 mt-2 opacity-0 group-hover:opacity-100 transition duration-300">
                            <a href="{{ route('brands.edit', $brand->id) }}" 
                            class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                                Edit
                            </a>
                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" 
                                onsubmit="return confirm('Are you sure you want to delete this brand?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <p class="mt-4 text-gray-500 text-lg">No brands found.</p>
                        <a href="{{ route('brands.create') }}" class="mt-4 inline-block text-blue-500 hover:text-blue-700 font-medium">
                            Add your first brand →
                        </a>
                    </div>
                @endforelse

            </div>

            <!-- Total Count -->
            @if($brands->count() > 0)
            <div class="mt-6 text-center text-sm text-gray-500">
                Showing {{ $brands->count() }} brand{{ $brands->count() > 1 ? 's' : '' }}
            </div>
            @endif

        </div>
    </div>

    <!-- Search Script -->
    <script>
        document.getElementById('searchBrand').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const brandCards = document.querySelectorAll('[data-brand-name]');
            
            brandCards.forEach(card => {
                const brandName = card.getAttribute('data-brand-name');
                if (brandName.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>