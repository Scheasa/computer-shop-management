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
                <a href="{{ url('/dashboard') }}" class="hover:text-gray-700">Home</a> 
                <span class="mx-2">/</span> 
                <span class="font-semibold text-gray-800">All Brands</span>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Grid Layout -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                
                @foreach($brands as $brand)
                    <div class="group relative">
                        <div class="bg-white border border-gray-200 rounded-lg h-40 flex items-center justify-center p-4 hover:shadow-lg hover:border-blue-500 transition duration-300">
                            
                            @if($brand->image)
                                <img src="{{ asset('storage/' . $brand->image) }}" 
                                     alt="{{ $brand->name }}" 
                                     class="max-h-24 max-w-full object-contain">
                            @else
                                <span class="text-gray-700 font-medium text-lg">
                                    {{ $brand->name }}
                                </span>
                            @endif

                        </div>
                        
                        <!-- Brand Name Below Card -->
                        <p class="text-center text-sm text-gray-600 mt-2 font-medium truncate">
                            {{ $brand->name }}
                        </p>

                        <!-- Action Buttons (Edit/Delete) -->
                        <div class="flex justify-center gap-2 mt-2 opacity-0 group-hover:opacity-100 transition duration-300">
                            <a href="{{ route('brands.edit', $brand->id) }}" class="text-blue-500 hover:text-blue-700 text-sm">Edit</a>
                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Empty State -->
            @if($brands->count() == 0)
                <div class="text-center py-12 bg-white rounded-lg shadow">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <p class="mt-2 text-gray-500">No brands found.</p>
                    <a href="{{ route('brands.create') }}" class="mt-4 inline-block text-blue-500 hover:text-blue-700">Add your first brand</a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>