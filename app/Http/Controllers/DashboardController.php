<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Notifikasi;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('is_role', '5')->count();
        $product = Product::all()->count();
        $category = Category::all()->count();
        $order = Order::all()->count();

        return view('dashboard.index', [
            'users_count' => $user,
            'products_count' => $product,
            'categories_count' => $category,
            'orders_count' => $order,
            'todo' => Notifikasi::to_do_list()
        ]);
    }
}
