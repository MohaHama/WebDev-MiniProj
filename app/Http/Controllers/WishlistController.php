<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class WishlistController extends Controller
{
    //Show all products in the logged-in user's wishlist
    public function index()
    {
        $products = auth()->user()->products;

        return view('wishlist', compact('products'));
    }

    //Add a product to the logged-in user's wishlist
    public function store($id)
    {
        $product = Product::findOrFail($id);

        //Add the product only if it is not already in the wishlist
        auth()->user()->products()->syncWithoutDetaching([$product->id]);

        return redirect()->route('wishlist.index');
    }

    //Remove a product from the logged-in user's wishlist
    public function destroy($id)
    {
        //Remove the connection between the user and the product
        auth()->user()->products()->detach($id);

        return redirect()->route('wishlist.index');
    }
}
