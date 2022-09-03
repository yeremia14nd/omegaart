<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Production;

class InvoiceController extends Controller
{

    public function index()
    {
        $order = Order::where('user_id', auth()->user()->id)->get()->modelKeys();
        $invoices = Invoice::whereIn('order_id', $order)->where('is_validated', '1')->get();
        $production = Production::whereIn('order_id', $order)->get();

        return view('invoices.index', [
            'title' => 'Daftar Invoice',
            'active' => 'invoice',
            'invoices' => $invoices,
            // 'payments' => $payments,
            'production' => $production,
        ]);
    }
}
