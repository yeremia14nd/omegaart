<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardCategoryController extends Controller
{

    public function index()
    {
        if (Gate::any(['superadmin', 'admin'])) {
            return view('dashboard.categories.index', [
                'categories' => Category::all(),
            ]);
        } else {
            abort(403);
        }
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'imageAssets' => 'required|image|file|max:2048',
            'description' => 'required',
        ]);

        if ($request->file('imageAssets')) {
            $validatedData['imageAssets'] = $request->file('imageAssets')->store('product-images');
        }

        // $validatedData['imageAssets'] = 'images1';

        Category::create($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Kategori baru sudah ditambahkan');
    }

    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'category' => $category,
        ]);
    }


    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
            'imageAssets' => 'image|file|max:2048',
            'description' => 'required',
        ];

        if ($request->slug != $category->slug) {
            $rules['slug'] = 'required|unique:categories';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('imageAssets')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['imageAssets'] = $request->file('imageAssets')->store('product-images');
        }

        Category::where('id', $category->id)->update($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Kategori sudah diubah!');
    }

    public function destroy(Category $category)
    {
        if ($category->imageAssets) {
            Storage::delete($category->imageAssets);
        }
        Category::destroy($category->id);

        return redirect('/dashboard/categories')->with('success', 'Kategori sudah dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
