<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|string|max:60|unique:products,sku',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_visible' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attributes' => 'nullable|array',
        ]);

        $data = $request->except(['image', 'attributes']);
        $data['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        // Save Attributes (PDF Schema)
        if ($request->has('attributes')) {
            foreach ($request->attributes as $attr) {
                if (!empty($attr['name']) && !empty($attr['value'])) {
                    $product->attributes()->create($attr);
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'attributes']);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sku' => 'required|string|max:60|unique:products,sku,' . $product->id,
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_visible' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        $data['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }

    // Add this method to your ProductController

    public function byBrand(Brand $brand)
    {
        $products = Product::where('brand_id', $brand->id)
                        ->where('is_visible', true)
                        ->with(['category', 'brand'])
                        ->latest()
                        ->paginate(12);
        
        return view('products.by-brand', compact('products', 'brand'));
    }

    // Add these methods to your existing ProductController

    public function shop(Request $request)
    {
        $query = Product::where('is_visible', true)
                        ->where('stock', '>', 0)
                        ->with(['category', 'brand']);

        // Filter by category
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->has('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::whereNull('parent_id')->get();
        $brands = Brand::all();

        return view('\customers\shops.index', compact('products', 'categories', 'brands'));
    }

    public function shopShow(Product $product)
    {
        if (!$product->is_visible) {
            abort(404);
        }

        $product->load(['category', 'brand', 'attributes']);
        
        // Related products (same category)
        $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $product->id)
                                ->where('is_visible', true)
                                ->where('stock', '>', 0)
                                ->take(4)
                                ->get();

        return view('\customers\shops.show', compact('product', 'relatedProducts'));
    }
}