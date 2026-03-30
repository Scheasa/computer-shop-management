<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <!-- Order Info -->
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Customer (Optional)</label>
                                <select name="user_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
                                    <option value="">-- Walk-in Customer --</option>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                                <p class="text-gray-500 text-xs mt-1">Leave empty for walk-in customer</p>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Order Status</label>
                                <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500">
                                    <option value="pending" selected>Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Products Selection -->
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Add Products to Order</h3>
                        
                        <div id="products-container">
                            <div class="product-row grid grid-cols-12 gap-4 mb-4 items-end">
                                <div class="col-span-7">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Product</label>
                                    <select name="items[0][product_id]" class="product-select shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
                                        <option value="">-- Select Product --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" 
                                                    data-price="{{ $product->price }}" 
                                                    data-stock="{{ $product->stock }}"
                                                    data-name="{{ $product->name }}">
                                                {{ $product->name }} (SKU: {{ $product->sku }}) - Stock: {{ $product->stock }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                                    <input type="number" name="items[0][quantity]" value="1" min="1" class="quantity-input shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                                    <input type="text" class="price-display shadow border rounded w-full py-2 px-3 text-gray-700 bg-gray-100" readonly value="$0.00">
                                </div>
                                <div class="col-span-1">
                                    <button type="button" onclick="removeProductRow(this)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded h-10">
                                        ✕
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" onclick="addProductRow()" class="mt-2 text-blue-500 hover:text-blue-700 text-sm font-medium">
                            + Add Another Product
                        </button>
                    </div>

                    <!-- Order Summary -->
                    <div class="p-6 bg-gray-50">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Order Summary</h3>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Total Amount</p>
                                <p class="text-2xl font-bold text-green-600" id="order-total">$0.00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="p-6 flex items-center justify-between">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                            Create Order
                        </button>
                        <a href="{{ route('orders.index') }}" class="text-gray-500 hover:text-gray-800 font-medium">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- JavaScript for Dynamic Product Rows -->
    <script>
        let productCount = 1;

        function addProductRow() {
            const container = document.getElementById('products-container');
            const newRow = document.createElement('div');
            newRow.className = 'product-row grid grid-cols-12 gap-4 mb-4 items-end';
            newRow.innerHTML = `
                <div class="col-span-7">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Product</label>
                    <select name="items[${productCount}][product_id]" class="product-select shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
                        <option value="">-- Select Product --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" 
                                    data-price="{{ $product->price }}" 
                                    data-stock="{{ $product->stock }}"
                                    data-name="{{ $product->name }}">
                                {{ $product->name }} (SKU: {{ $product->sku }}) - Stock: {{ $product->stock }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                    <input type="number" name="items[${productCount}][quantity]" value="1" min="1" class="quantity-input shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                    <input type="text" class="price-display shadow border rounded w-full py-2 px-3 text-gray-700 bg-gray-100" readonly value="$0.00">
                </div>
                <div class="col-span-1">
                    <button type="button" onclick="removeProductRow(this)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded h-10">
                        ✕
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            
            // Add event listeners to new row
            const select = newRow.querySelector('.product-select');
            const quantity = newRow.querySelector('.quantity-input');
            const priceDisplay = newRow.querySelector('.price-display');
            
            select.addEventListener('change', function() {
                updatePrice(this, quantity, priceDisplay);
            });
            
            quantity.addEventListener('input', function() {
                updatePrice(select, this, priceDisplay);
            });
            
            productCount++;
        }

        function removeProductRow(button) {
            const row = button.closest('.product-row');
            if (document.querySelectorAll('.product-row').length > 1) {
                row.remove();
                calculateTotal();
            } else {
                alert('You need at least one product in the order.');
            }
        }

        function updatePrice(select, quantity, priceDisplay) {
            const option = select.options[select.selectedIndex];
            const price = parseFloat(option.getAttribute('data-price')) || 0;
            const qty = parseInt(quantity.value) || 0;
            const total = price * qty;
            priceDisplay.value = '$' + total.toFixed(2);
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.product-row').forEach(row => {
                const select = row.querySelector('.product-select');
                const quantity = row.querySelector('.quantity-input');
                const option = select.options[select.selectedIndex];
                const price = parseFloat(option.getAttribute('data-price')) || 0;
                const qty = parseInt(quantity.value) || 0;
                total += price * qty;
            });
            document.getElementById('order-total').textContent = '$' + total.toFixed(2);
        }

        // Initialize event listeners on first row
        document.addEventListener('DOMContentLoaded', function() {
            const firstRow = document.querySelector('.product-row');
            const select = firstRow.querySelector('.product-select');
            const quantity = firstRow.querySelector('.quantity-input');
            const priceDisplay = firstRow.querySelector('.price-display');
            
            select.addEventListener('change', function() {
                updatePrice(this, quantity, priceDisplay);
            });
            
            quantity.addEventListener('input', function() {
                updatePrice(select, this, priceDisplay);
            });
        });
    </script>
</x-app-layout>