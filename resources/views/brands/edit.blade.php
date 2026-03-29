<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Brand Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Brand Name <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" 
                               id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name', $brand->name) }}" 
                               required>
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="slug">
                            Slug <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" 
                               id="slug" 
                               type="text" 
                               name="slug" 
                               value="{{ old('slug', $brand->slug) }}" 
                               required>
                    </div>

                    <!-- Current Logo -->
                    @if($brand->image)
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Current Logo
                        </label>
                        <div class="border rounded-lg p-4 h-32 flex items-center justify-center bg-gray-50">
                            <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="max-h-24 max-w-full object-contain">
                        </div>
                        <p class="text-gray-500 text-xs mt-2">Upload a new image to replace it.</p>
                    </div>
                    @endif

                    <!-- New Logo -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            Upload New Logo
                        </label>
                        <input type="file" name="image" accept="image/*" 
                               class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
                        <p class="text-gray-500 text-xs mt-1">PNG, JPG, GIF, SVG (Max 2MB)</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between mt-6">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Update Brand
                        </button>
                        <a class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800" href="{{ route('brands.index') }}">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>