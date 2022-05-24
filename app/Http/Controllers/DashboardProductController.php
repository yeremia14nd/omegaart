<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
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
        //return Product::all();
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
            'name' => 'required|max:255',
            'slug' => 'required|unique:products',
            'category_id' => 'required',
            'imageAssets' => 'required|image|file|max:2048',
            'price' => 'required',
            'workDuration' => 'required',
            'weight' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('imageAssets')) {
            $validatedData['imageAssets'] = $request->file('imageAssets')->store('product-images');
        }

        // $validatedData['employee_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 25);
        // $validatedData['imageAssets'] = 'images1';

        Product::create($validatedData);

        return redirect('/dashboard/products')->with('success', 'New Product has been added');
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
            'imageAssets' => 'image|file|max:2048',
            'price' => 'required',
            'workDuration' => 'required',
            'weight' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ];

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

        return redirect('/dashboard/products')->with('success', 'Product has been updated!');
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

        return redirect('/dashboard/products')->with('success', 'Product has been deleted');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
