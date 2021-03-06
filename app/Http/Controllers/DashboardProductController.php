<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAvailability;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.products.index', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'categories' => Category::all(),
            'product_availability' => ProductAvailability::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->file('imageAssets')->store('product-images');

        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products',
            'category_id' => 'required',
            'product_availability_id' => 'required',
            'imageAssets' => 'required|image|file|max:2048',
            'price' => 'required',
            'workDuration' => 'required',
            'weight' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ]);

        $validatedData['price'] = str_replace(".", "", $request->price);

        if ($request->file('imageAssets')) {
            $validatedData['imageAssets'] = $request->file('imageAssets')->store('product-images');
        }

        // $validatedData['employee_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 150);
        // $validatedData['imageAssets'] = 'images1';

        Product::create($validatedData);

        return redirect('/dashboard/products')->with('success', 'Produk baru sudah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'product_availability' => ProductAvailability::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'product_availability_id' => 'required',
            'imageAssets' => 'image|file|max:2048',
            'price' => 'required',
            'workDuration' => 'required',
            'weight' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ];

        $validatedData['price'] = str_replace(".", "", $request->price);

        if ($request->slug != $product->slug) {
            $rules['slug'] = 'required|unique:products';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('imageAssets')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['imageAssets'] = $request->file('imageAssets')->store('product-images');
        }

        // $validatedData['employee_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 25);

        Product::where('id', $product->id)->update($validatedData);

        return redirect('/dashboard/products')->with('success', 'Produk sudah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->imageAssets) {
            Storage::delete($product->imageAssets);
        }
        Product::destroy($product->id);

        return redirect('/dashboard/products')->with('success', 'Produk sudah dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
