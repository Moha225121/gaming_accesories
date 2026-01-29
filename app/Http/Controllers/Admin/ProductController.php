<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/products'), $imageName);
            $validated['image'] = $imageName;
        }

        Product::create($validated);
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && file_exists(public_path('storage/products/'.$product->image))) {
                unlink(public_path('storage/products/'.$product->image));
            }
            
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/products'), $imageName);
            $validated['image'] = $imageName;
        }

        $product->update($validated);
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        // Delete image
        if ($product->image && file_exists(public_path('storage/products/'.$product->image))) {
            unlink(public_path('storage/products/'.$product->image));
        }
        
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}
