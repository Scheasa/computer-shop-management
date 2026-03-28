<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Computer Shop - Home</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-800">Computer Shop</span>
                    </a>
                </div>

                <!-- Menu Items -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
                    <a href="#products" class="text-gray-700 hover:text-blue-600 font-medium">Products</a>
                    <a href="#brands" class="text-gray-700 hover:text-blue-600 font-medium">Brands</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Categories</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                        {{-- <a href="{{ route('products.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium">Admin Panel</a> --}}
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">Log in</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Welcome to Computer Shop
                </h1>
                <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                    Your one-stop destination for quality computers, laptops, and accessories. 
                    Browse our collection of top brands at competitive prices.
                </p>
                <div class="flex justify-center gap-4">
                    <a href="#products" class="bg-white text-blue-600 px-8 py-3 rounded-md font-semibold hover:bg-gray-100 transition">
                        Browse Products
                    </a>
                    <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-3 rounded-md font-semibold hover:bg-white/10 transition">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Shop by Category</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Category 1 -->
                <a href="#" class="group block">
                    <div class="bg-gray-100 rounded-lg p-8 text-center hover:bg-blue-50 transition duration-300">
                        <svg class="w-12 h-12 mx-auto text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">Laptops</h3>
                    </div>
                </a>

                <!-- Category 2 -->
                <a href="#" class="group block">
                    <div class="bg-gray-100 rounded-lg p-8 text-center hover:bg-blue-50 transition duration-300">
                        <svg class="w-12 h-12 mx-auto text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">Desktops</h3>
                    </div>
                </a>

                <!-- Category 3 -->
                <a href="#" class="group block">
                    <div class="bg-gray-100 rounded-lg p-8 text-center hover:bg-blue-50 transition duration-300">
                        <svg class="w-12 h-12 mx-auto text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">Accessories</h3>
                    </div>
                </a>

                <!-- Category 4 -->
                <a href="#" class="group block">
                    <div class="bg-gray-100 rounded-lg p-8 text-center hover:bg-blue-50 transition duration-300">
                        <svg class="w-12 h-12 mx-auto text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">Monitors</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="products" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Featured Products</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Product 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Dell XPS 15</h3>
                        <p class="text-sm text-gray-500 mb-2">Dell</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-blue-600">$1,499.99</span>
                            <span class="text-xs text-green-600">In Stock</span>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">HP Pavilion</h3>
                        <p class="text-sm text-gray-500 mb-2">HP</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-blue-600">$899.99</span>
                            <span class="text-xs text-green-600">In Stock</span>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Asus ROG</h3>
                        <p class="text-sm text-gray-500 mb-2">Asus</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-blue-600">$1,299.99</span>
                            <span class="text-xs text-green-600">In Stock</span>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">MacBook Pro</h3>
                        <p class="text-sm text-gray-500 mb-2">Apple</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-blue-600">$2,499.99</span>
                            <span class="text-xs text-green-600">In Stock</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                {{-- <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-semibold transition"> --}}
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section id="brands" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Our Brands</h2>
            
            <!-- Grid Layout (Same as brands/index.blade.php) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                
                <!-- Brand 1 -->
                <div class="group relative">
                    <div class="bg-white border border-gray-200 rounded-lg h-40 flex items-center justify-center p-4 hover:shadow-lg hover:border-blue-500 transition duration-300">
                        <span class="text-gray-700 font-medium text-lg">Dell</span>
                    </div>
                </div>

                <!-- Brand 2 -->
                <div class="group relative">
                    <div class="bg-white border border-gray-200 rounded-lg h-40 flex items-center justify-center p-4 hover:shadow-lg hover:border-blue-500 transition duration-300">
                        <span class="text-gray-700 font-medium text-lg">HP</span>
                    </div>
                </div>

                <!-- Brand 3 -->
                <div class="group relative">
                    <div class="bg-white border border-gray-200 rounded-lg h-40 flex items-center justify-center p-4 hover:shadow-lg hover:border-blue-500 transition duration-300">
                        <span class="text-gray-700 font-medium text-lg">Asus</span>
                    </div>
                </div>

                <!-- Brand 4 -->
                <div class="group relative">
                    <div class="bg-white border border-gray-200 rounded-lg h-40 flex items-center justify-center p-4 hover:shadow-lg hover:border-blue-500 transition duration-300">
                        <span class="text-gray-700 font-medium text-lg">Acer</span>
                    </div>
                </div>

                <!-- Brand 5 -->
                <div class="group relative">
                    <div class="bg-white border border-gray-200 rounded-lg h-40 flex items-center justify-center p-4 hover:shadow-lg hover:border-blue-500 transition duration-300">
                        <span class="text-gray-700 font-medium text-lg">MSI</span>
                    </div>
                </div>

                <!-- Brand 6 -->
                <div class="group relative">
                    <div class="bg-white border border-gray-200 rounded-lg h-40 flex items-center justify-center p-4 hover:shadow-lg hover:border-blue-500 transition duration-300">
                        <span class="text-gray-700 font-medium text-lg">Apple</span>
                    </div>
                </div>

            </div>

            <div class="text-center mt-12">
                <a href="#" class="inline-block text-blue-600 hover:text-blue-800 font-semibold">
                    View All Brands →
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Quality Products</h3>
                    <p class="text-gray-600">All products are verified and come with warranty.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Best Prices</h3>
                    <p class="text-gray-600">Competitive pricing with regular discounts.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Dedicated customer support for all inquiries.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Computer Shop</h3>
                    <p class="text-gray-400">Your trusted partner for quality computers and accessories.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                        <li><a href="#products" class="hover:text-white">Products</a></li>
                        <li><a href="#brands" class="hover:text-white">Brands</a></li>
                        <li><a href="#categories" class="hover:text-white">Categories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Account</h4>
                    <ul class="space-y-2 text-gray-400">
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="hover:text-white">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white">Login</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white">Register</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📧 info@computershop.com</li>
                        <li>📞 +1 234 567 890</li>
                        <li>📍 123 Tech Street, City</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Computer Shop. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>