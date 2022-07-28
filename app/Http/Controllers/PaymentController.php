<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Checkout;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($id)
  {
    $checkout = Checkout::findOrFail($id);
    $users = User::findOrFail(Auth::id());
    $cart_item = Cart::where('id', $checkout->cart_id)->first();
    $data = array(
      'cartsession' => session('cart'),
      'title' => 'Checkout',
      'active' => 'checkout',
      'id_checkout' => $id,
      'cart_item' => $cart_item,
      'users' => $users,
      'checkout' => $checkout
    );

    return view('payments.payment', $data);
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
   * @param \App\Http\Requests\StorePaymentRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
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

    $validatedData['total_price_paid'] = str_replace(".", "", $request->total_price_paid);

    if ($validatedData['total_price_paid'] < $invoice->total_price_product) {
      $validatedData['has_paid_down_payment'] = 1;
      $validatedData['has_paid_full'] = 0;
    }

    if ($validatedData['total_price_paid'] == $invoice->total_price_product || $validatedData['total_price_paid'] > $invoice->total_price_product) {
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

    Invoice::where('id', $invoice->id)->update([
      'is_paid_confirmed' => 0
    ]);

    Notifikasi::createNotification('admin', 'invoice_order');

    return redirect('/invoices')->with('success', 'Pembayaran berhasil, menunggu konfirmasi');
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Payment $payment
   * @return \Illuminate\Http\Response
   */
  public function show(Payment $payment)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Payment $payment
   * @return \Illuminate\Http\Response
   */
  public function edit(Payment $payment)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \App\Http\Requests\UpdatePaymentRequest $request
   * @param \App\Models\Payment $payment
   * @return \Illuminate\Http\Response
   */
  public function update(UpdatePaymentRequest $request, Payment $payment)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Payment $payment
   * @return \Illuminate\Http\Response
   */
  public function destroy(Payment $payment)
  {
    //
  }

  public function add_checkout(Request $request)
  {
    $id = Auth::id();
    $id_cart = $request->id_cart;

    $input['user_id'] = $id;
    $input['total'] = $request->total;
    $input['payment_photo'] = 'null';
    $input['pay_until'] = date('Y-m-d H:i:s', strtotime(" +1 days"));
    $input['shipping_address'] = 'test';
    $input['status'] = 0;
    $input['cart_id'] = $id_cart;
    $input['payment_type'] = 'empty';

    $checkout = Checkout::create($input);

    if ($checkout) {
      Cart::where('id', $id_cart)
        ->update([
          'status_cart' => 'checkout'
        ]);
      return redirect()->route('checkout', $checkout->id)->with('success', 'Silahkan Mengisi Data Berikut Untuk Pengiriman');
    } else {
      return redirect()->route('cart')->with('success', 'Produk Berhasil Ditambah ke Cart');
    }
  }

  public function payment(Request $request, $id)
  {
    $checkout = Checkout::findOrFail($id);
    $address = $request->address;
    $provinsi = $request->provinsi;
    $kota = $request->kota;
    $kelurahan = $request->kelurahan;
    $kodepos = $request->kodepos;
    $phone = $request->phone_number;


    $shipping_address = $address . ', ' . $kelurahan . ', ' . $kota . ', ' . $provinsi . ', ' . $kodepos;
    $payment_type = $request->payment;

    if ($request->file('bukti_pembayaran')) {
      $payment_photo = $request->file('bukti_pembayaran')->store('payment');
      $checkout->updatecheckout($shipping_address, $payment_type, $payment_photo, $phone);

      // Add notification
      Notifikasi::createNotification("admin", "checkout");

      return redirect()->route('checkout.confirmation', $id);
    } else {
      return back()->with('error', 'Silahkan Upload Bukti Pembayaran Anda');
    }
  }

  public function confirmation_payment($id)
  {
    $checkout = Checkout::findOrFail($id);
    $data = array(
      'title' => 'Confirmation',
      'active' => 'confirmation',
      'checkout' => $checkout
    );
    return view('payments.confirmation', $data);
  }
}
