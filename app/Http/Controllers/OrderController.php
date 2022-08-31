<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;



class OrderController extends Controller
{

    public function store(StoreOrderRequest $request)
    {
        $user = auth()->user();

        $product = Product::where('id', $request->product_id)->first();

        $data = [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ];

        $order = Order::create($data);

        session(['order' => $order]);

        return redirect('/surveys/create')->with([
            'success' => 'Continue Order to Survei',
        ]);
    }

    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        session()->forget('order');

        return redirect('/shop');
    }
}
