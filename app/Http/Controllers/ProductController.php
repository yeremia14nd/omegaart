<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {
        return view('shop', [
            "title" => "All Products",
            "active" => 'shop',
            "products" => Product::latest()->filter(request(['search', 'category']))->paginate(9)->withQueryString()
        ]);
    }

    public function show(Product $product)
    {
        return view('product', [
            "title" => $product->name,
            "active" => 'shop',
            "product" => $product,
        ]);
    }
}
