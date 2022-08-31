<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Product;


class CartController extends Controller
{

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

  public function total_cart()
  {
    $id = Auth::id();
    $data = Cart::totalcart($id);
    return $data;
  }
}
