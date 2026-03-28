<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Brand Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Brand Name <span class="text-red-500">*</span>
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" 
                               id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required
                               placeholder="e.g., Dell, HP, Asus">
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
                               value="{{ old('slug') }}" 
                               required
                               placeholder="e.g., dell, hp, asus">
                        <p class="text-gray-500 text-xs italic mt-1">Must be unique and lowercase (no spaces).</p>
                    </div>

                    <!-- Brand Logo -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            Brand Logo
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition duration-300">
                            <input class="w-full" 
                                   id="image" 
                                   type="file" 
                                   name="image" 
                                   accept="image/*">
                            <p class="text-gray-500 text-xs mt-2">PNG, JPG, GIF, SVG (Max 2MB)</p>
                        </div>
                    </div>

                    <!-- Preview Area -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Logo Preview
                        </label>
                        <div id="preview-container" class="border rounded-lg p-4 h-32 flex items-center justify-center bg-gray-50">
                            <span class="text-gray-400 text-sm">No image selected</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Save Brand
                        </button>
                        <a class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800" href="{{ route('brands.index') }}">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Image Preview Script -->
    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('preview-container');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="max-h-24 max-w-full object-contain">`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '<span class="text-gray-400 text-sm">No image selected</span>';
            }
        });
    </script>
</x-app-layout>