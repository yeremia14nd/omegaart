<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardOrderController extends Controller
{

    public function index()
    {
        return view('dashboard.orders.index', [
            'orders' => Order::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.orders.create', [
            'users' => User::all(),
            'products' => Product::where('product_availability_id', '2')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'status' => 'required',
        ]);

        Order::create($validatedData);

        return redirect('/dashboard/orders')->with([
            'success' => 'Order baru sudah ditambahkan',
        ]);
    }

    public function show(Order $order)
    {
        return view('dashboard.orders.show', [
            'order' => $order,
        ]);
    }

    public function edit(Order $order)
    {
        return view('dashboard.orders.edit', [
            'order' => $order,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $rules = [
            'is_survey_scheduled' => 'required',
            'is_surveyed' => 'required',
            'is_invoice_sent' => 'required',
            'is_paid_invoiced' => 'required',
            'is_productioned' => 'required',
            'is_installed' => 'required',
            'is_final_invoice_sent' => 'required',
            'is_final_invoice_paid' => 'required',
            'status' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Order::where('id', $order->id)->update($validatedData);

        return redirect('/dashboard/orders')->with('success', 'Order sudah diubah');
    }


    public function destroy(Order $order)
    {
        Order::destroy($order->id);

        return redirect('/dashboard/orders')->with('success', 'Order sudah dihapus!');
    }
}
