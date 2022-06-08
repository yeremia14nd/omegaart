<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Product;


class CartController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // $cart = session('cart');
    // return view('cart')->with('cart', $cart);
    if (Auth::check()) {
      $itemuser = $request->user();
      $itemcart = Cart::where('user_id', $itemuser->id)
        ->where('status_cart', 'cart')
        ->first();
      $data = array(
        'title' => 'Cart',
        'itemcart' => $itemcart,
        'title' => 'All Products',
        'active' => 'cart',
      );
      return view('cart', $data)->with('no', 1);
    } else {
      $data = array(
        'title' => 'Cart',
        'cartsession' => session('cart'),
        'title' => 'All Products',
        'active' => 'cart',
      );
      return view('cart', $data)->with('no', 1);
      // dd($data);
    }
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
   * @param  \App\Http\Requests\StoreCartRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function add_cart($id_produk)
  {
    $cart = session('cart');

    $product = Product::where('id', $id_produk)->first();

    $cart['id_produk'] = [
      'nama_produk' => $product->name,
      'harga_produk' => $product->price,
      'jumlah' => 1,
    ];

    session(['cart' => $cart]);
    // dd(session('cart'));
    return redirect('/cart');
  }

  public function store(StoreCartRequest $request)
  {
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Cart  $cart
   * @return \Illuminate\Http\Response
   */
  public function show(Cart $cart)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Cart  $cart
   * @return \Illuminate\Http\Response
   */
  public function edit(Cart $cart)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateCartRequest  $request
   * @param  \App\Models\Cart  $cart
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCartRequest $request, Cart $cart)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Cart  $cart
   * @return \Illuminate\Http\Response
   */
  public function destroy(Cart $cart)
  {
    //
  }

  public function kosongkan($id)
  {
    $itemcart = Cart::findOrFail($id);
    $itemcart->detail()->delete(); //hapus semua item di cart detail
    $itemcart->updatetotal($itemcart, '-' . $itemcart->subtotal);
    return back()->with('success', 'Cart berhasil dikosongkan');
  }

  public function emptySession()
  {
    session()->flush();
    return back()->with('success', 'Cart berhasil dikosongkan');
  }

  public function total_cart(){
    $id = Auth::id();
    $data = Cart::totalcart($id);
    return $data;
  }
}
