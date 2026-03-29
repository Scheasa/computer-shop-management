<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">Error!</strong>
                        <ul class="list-disc list-inside mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- SKU -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="sku">
                                SKU <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" 
                                   class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
                            <p class="text-gray-500 text-xs mt-1">Unique product identifier</p>
                        </div>

                        <!-- Product Name -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                                   class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
                        </div>

                        <!-- Slug -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="slug">
                                Slug <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" 
                                   class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
                            <p class="text-gray-500 text-xs mt-1">e.g., dell-xps-15-2024</p>
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" id="category_id" 
                                    class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Brand -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="brand_id">
                                Brand
                            </label>
                            <select name="brand_id" id="brand_id" 
                                    class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
                                <option value="">-- Select Brand --</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                Price ($) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" 
                                   class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">
                                Stock Quantity <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" 
                                   class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
                        </div>

                        <!-- Is Visible -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Visibility</label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_visible" value="1" 
                                       {{ old('is_visible', $product->is_visible) ? 'checked' : '' }} 
                                       class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-gray-700">Show on website</span>
                            </label>
                        </div>

                        <!-- Current Product Image -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Current Image</label>
                            @if($product->image)
                                <div class="border rounded-lg p-2 bg-gray-50">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                         class="w-full h-40 object-cover rounded">
                                    <p class="text-gray-500 text-xs mt-2">Upload a new image to replace it</p>
                                </div>
                            @else
                                <div class="border rounded-lg p-8 bg-gray-50 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-gray-500 text-sm mt-2">No image uploaded</p>
                                </div>
                            @endif
                        </div>

                        <!-- New Product Image -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                Upload New Image
                            </label>
                            <input type="file" name="image" id="image" accept="image/*" 
                                   class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
                            <p class="text-gray-500 text-xs mt-1">PNG, JPG, GIF (Max 2MB)</p>
                        </div>

                    </div>

                    <!-- Product Attributes Section -->
                    <div class="mt-8 border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Product Specifications (Attributes)</h3>
                        <p class="text-gray-500 text-sm mb-4">Add or update technical specs like RAM, CPU, Storage, etc.</p>
                        
                        <!-- Existing Attributes -->
                        <div id="attributes-container">
                            @if($product->attributes->count() > 0)
                                @foreach($product->attributes as $index => $attr)
                                <div class="attribute-row grid grid-cols-2 gap-4 mb-3">
                                    <input type="text" name="attributes[{{ $index }}][name]" 
                                           value="{{ $attr->name }}"
                                           placeholder="Attribute Name" 
                                           class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
                                    <input type="text" name="attributes[{{ $index }}][value]" 
                                           value="{{ $attr->value }}"
                                           placeholder="Value" 
                                           class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
                                </div>
                                @endforeach
                            @else
                                <div class="attribute-row grid grid-cols-2 gap-4 mb-3">
                                    <input type="text" name="attributes[0][name]" placeholder="Attribute Name (e.g., RAM)" 
                                           class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
                                    <input type="text" name="attributes[0][value]" placeholder="Value (e.g., 16GB)" 
                                           class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
                                </div>
                            @endif
                        </div>
                        
                        <button type="button" onclick="addAttribute()" 
                                class="mt-2 text-blue-500 hover:text-blue-700 text-sm font-medium">
                            + Add Another Specification
                        </button>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex items-center justify-between mt-8 pt-6 border-t">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                            Update Product
                        </button>
                        <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-800 font-medium">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- JavaScript to Add More Attributes -->
    <script>
        let attributeCount = {{ $product->attributes->count() > 0 ? $product->attributes->count() : 1 }};
        
        function addAttribute() {
            const container = document.getElementById('attributes-container');
            const newRow = document.createElement('div');
            newRow.className = 'attribute-row grid grid-cols-2 gap-4 mb-3';
            newRow.innerHTML = `
                <input type="text" name="attributes[${attributeCount}][name]" placeholder="Attribute Name" 
                       class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
                <input type="text" name="attributes[${attributeCount}][value]" placeholder="Value" 
                       class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
            `;
            container.appendChild(newRow);
            attributeCount++;
        }
    </script>
</x-app-layout>