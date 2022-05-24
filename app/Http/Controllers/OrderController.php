<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\User;
use App\Models\Product;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'slug' => 'required|unique:products',
        //     'category_id' => 'required',
        //     'imageAssets' => 'required|image|file|max:2048',
        //     'price' => 'required',
        //     'workDuration' => 'required',
        //     'weight' => 'required',
        //     'stock' => 'required',
        //     'description' => 'required',
        // ]);
        //user id
        // dd($request->product_id);
        $user = User::where('id', $request->user_id)->first();
        //product id
        $product = Product::where('id', $request->product_id)->first();

        $data = [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ];

        Order::create($data);

        return redirect('/surveys/create')->with([
            'success' => 'Continue Order to Survey',
            'product' => $product->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
