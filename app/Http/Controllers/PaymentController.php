<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'title' => 'Checkout',
            'cartsession' => session('cart'),
            'title' => 'Checkout',
            'active' => 'shop'
        );
        return view('payment', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $invoice = Invoice::where('id', $request->invoice_id)->first();

        if (auth()->user()->id == $request->user_id) {
            return view('payments.create', [
                'title' => 'Payment',
                'active' => 'payment',
                'invoice' => $invoice,
                'user' => $request->user(),
            ]);
        }
        return redirect('/invoices');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        // dd($request);
        $invoice = Invoice::where('id', $request->invoice_id)->first();

        $validatedData = $request->validate([
            'invoice_id' => 'required',
            'user_id' => 'required',
            'total_price_paid' => 'required',
            'image_asset' => 'required|image|file|max:8200',
            'description' => 'required',
        ]);

        if ($request->total_price_paid  < $invoice->total_price_product) {
            $validatedData['has_paid_down_payment'] = 1;
            $validatedData['has_paid_full'] = 0;
        }

        if ($request->total_price_paid  == $invoice->total_price_product || $request->total_price_paid  > $invoice->total_price_product) {
            $validatedData['has_paid_down_payment'] = 1;
            $validatedData['has_paid_full'] = 1;
        }
        $validatedData['is_confirmed'] = 0;

        if ($request->file('image_asset')) {
            $validatedData['image_asset'] = $request->file('image_asset')->store('transfer-images');
        }
        // dd($validatedData);
        Payment::create($validatedData);

        Order::where('id', $invoice->order->id)->update(['is_paid_invoiced' => 1]);

        return redirect('/invoices')->with('success', 'Payment has been paid, waiting for confirmation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentRequest  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
