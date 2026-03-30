<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Computer Shop - Home</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">

    <!-- Top Announcement Bar -->
    <div class="bg-gray-900 text-white py-2 text-center text-sm">
        <p>🎉 Free Shipping on Orders Over $500 | Use Code: <span class="font-bold">WELCOME10</span> for 10% Off</p>
    </div>

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
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

                <!-- Center Menu (Desktop) -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Home</a>
                    <a href="{{ route('shop') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Shop</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Categories</a>
                    <a href="{{ route('brands.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Brands</a>
                </div>

                <!-- Right Side: Cart & Auth -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- Cart Icon -->
                        <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            @if(\App\Http\Controllers\CartController::count() > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                                    {{ \App\Http\Controllers\CartController::count() }}
                                </span>
                            @endif
                        </a>

                        <!-- User Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="hidden lg:inline">{{ auth()->user()->name }}</span>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition">
                                <a href="{{ route('shop') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Shop</a>
                                <a href="{{ route('orders.my') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Orders</a>
                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-t">Dashboard</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('shop') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Shop</a>
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Log in</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg hero-pattern py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                    Welcome to Computer Shop
                </h1>
                <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                    Your one-stop destination for quality computers, laptops, and accessories. 
                    Browse our collection of top brands at competitive prices.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('shop') }}" class="bg-white text-blue-600 px-8 py-3 rounded-md font-semibold hover:bg-gray-100 transition shadow-lg">
                        🛒 Shop Now
                    </a>
                    <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-3 rounded-md font-semibold hover:bg-white/10 transition">
                        Create Account
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Shop by Category</h2>
                <p class="text-gray-500">Find exactly what you're looking for</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($categories as $category)
                    <a href="{{ route('shop', ['category' => $category->id]) }}" class="group block">
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-8 text-center hover:shadow-lg hover:from-blue-50 hover:to-blue-100 transition duration-300 border border-gray-200">
                            <svg class="w-12 h-12 mx-auto text-blue-600 mb-4 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">
                                {{ $category->name }}
                            </h3>
                        </div>
                    </a>
                @empty
                    <!-- Default Categories -->
                    @foreach(['Laptops', 'Desktops', 'Accessories', 'Monitors'] as $cat)
                    <a href="{{ route('shop') }}" class="group block">
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-8 text-center hover:shadow-lg hover:from-blue-50 hover:to-blue-100 transition duration-300 border border-gray-200">
                            <svg class="w-12 h-12 mx-auto text-blue-600 mb-4 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">{{ $cat }}</h3>
                        </div>
                    </a>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="products" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Featured Products</h2>
                <p class="text-gray-500">Handpicked selection of our best products</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 group">
                        <a href="{{ route('shop.show', $product->id) }}" class="block">
                            <div class="h-48 bg-gray-100 flex items-center justify-center relative overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                                @if($product->stock <= 5 && $product->stock > 0)
                                    <span class="absolute top-2 right-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded">Low Stock</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-1 truncate">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500 mb-3">{{ $product->brand?->name ?? 'No Brand' }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-xs {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }} font-medium">
                                        {{ $product->stock > 0 ? '✓ In Stock' : '✗ Out of Stock' }}
                                    </span>
                                </div>
                            </div>
                        </a>
                        @if($product->stock > 0)
                        <div class="px-4 pb-4">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                @empty
                    @for($i = 0; $i < 4; $i++)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Product {{ $i + 1 }}</h3>
                                <p class="text-sm text-gray-500 mb-2">Brand Name</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-blue-600">$999.99</span>
                                    <span class="text-xs text-green-600">✓ In Stock</span>
                                </div>
                            </div>
                            <div class="px-4 pb-4">
                                <button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('shop') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-semibold transition shadow-md">
                    View All Products →
                </a>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section id="brands" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Our Brands</h2>
                <p class="text-gray-500">Trusted by leading manufacturers</p>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @forelse($brands as $brand)
                    <a href="{{ route('shop', ['brand' => $brand->id]) }}" class="group relative block">
                        <div class="bg-white border-2 border-gray-200 rounded-xl h-32 flex items-center justify-center p-4 hover:border-blue-500 hover:shadow-lg transition duration-300">
                            @if($brand->image)
                                <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="max-h-20 max-w-full object-contain group-hover:scale-105 transition">
                            @else
                                <span class="text-gray-700 font-semibold text-lg">{{ $brand->name }}</span>
                            @endif
                        </div>
                    </a>
                @empty
                    @foreach(['Dell', 'HP', 'Asus', 'Acer', 'MSI', 'Apple'] as $brandName)
                        <div class="group relative block">
                            <div class="bg-white border-2 border-gray-200 rounded-xl h-32 flex items-center justify-center p-4 hover:border-blue-500 hover:shadow-lg transition duration-300">
                                <span class="text-gray-700 font-semibold text-lg">{{ $brandName }}</span>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('brands.index') }}" class="inline-block text-blue-600 hover:text-blue-800 font-semibold">
                    View All Brands →
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Why Choose Us</h2>
                <p class="text-gray-500">We're committed to providing the best experience</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Quality Products</h3>
                    <p class="text-gray-600">All products are verified and come with warranty.</p>
                </div>
                <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Best Prices</h3>
                    <p class="text-gray-600">Competitive pricing with regular discounts.</p>
                </div>
                <div class="text-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Dedicated customer support for all inquiries.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Stay Updated</h2>
            <p class="text-gray-400 mb-8">Subscribe to get special offers, free giveaways, and once-in-a-lifetime deals.</p>
            <form class="flex flex-col sm:flex-row gap-4 justify-center">
                <input type="email" placeholder="Enter your email" class="px-6 py-3 rounded-md w-full sm:w-96 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-semibold transition">
                    Subscribe
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Computer Shop
                    </h3>
                    <p class="text-gray-400">Your trusted partner for quality computers and accessories.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('shop') }}" class="hover:text-white transition">Shop</a></li>
                        <li><a href="{{ route('brands.index') }}" class="hover:text-white transition">Brands</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-white transition">Categories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Account</h4>
                    <ul class="space-y-2 text-gray-400">
                        @auth
                            <li><a href="{{ route('orders.my') }}" class="hover:text-white transition">My Orders</a></li>
                            <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="hover:text-white transition">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white transition">Login</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white transition">Register</a></li>
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