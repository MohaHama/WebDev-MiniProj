<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        // Get all products from the database
        $products = Product::all();

        // Send products to the index view
        return view('index', ['products' => $products]);
    }

    // Show the create form
    public function create()
    {
        return view('create');
    }

    // Save a new product
    public function store(Request $request)
    {
        // Validate the form
        $request->validate([
            'name' => 'required|string',
            'qty' => 'required|integer',
            'price' => 'required|decimal:0,2',
            'description' => 'required|string',
            'image' => 'nullable|image'
        ]);

        // Create a new product
        $product = new Product();

        $product->name = $request->name;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->description = $request->description;

        // Save the image and its path
        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products');
        }

        // Save the product in the database
        $product->save();

        return redirect()->route('products.index');
    }

    // Show one product
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('show', ['product' => $product]);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete the image from storage
        if ($product->image_path) {
            Storage::delete($product->image_path);
        }

        // Delete the product from database
        $product->delete();

        return redirect()->route('products.index');
    }

    // Return the product image
    public function image($id)
    {
        $product = Product::findOrFail($id);

        if (!$product->image_path) {
            abort(404);
        }

        return response(
            Storage::get($product->image_path),
            200,
            ['Content-Type' => Storage::mimeType($product->image_path)]
        );
    }
}
