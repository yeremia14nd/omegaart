<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CartItem;
use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return abort('404');
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
   * @param  \App\Http\Requests\StoreCartItemRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $id = $request->product_id;
    $this->validate($request, [
      'product_id' => 'required',
    ]);
    $itemuser = $request->user();
    $itemproduk = Product::findOrFail($id);
    // cek dulu apakah sudah ada shopping cart untuk user yang sedang login

    if (Auth::check()) { //jika user sudah login
      Cart::addToCart($itemuser->id, $id);

      return redirect()->route('cart')->with('success', 'Produk Berhasil Ditambah ke Cart');
    } else { //jika user belum login
      $carts = session()->get('cart');

      //jika cart kosong
      if (!$carts) {
        $carts = [
          $id => [
            "id" => $id,
            "name" => $itemproduk->name,
            "quantity" => 1,
            "price" => $itemproduk->price,
            "subtotal" => $itemproduk->price * 1
          ]
        ];

        session()->put('cart', $carts);

        return redirect()->route('cart')->with('success', 'Produk Berhasil Ditambah ke Cart');
      }

      //jika cart tidak kosong, maka cek apakah produk ini ada lalu menambahkan quantity
      if (isset($carts[$id])) {
        $carts[$id]['quantity']++;
        session()->put('cart', $carts);
        return redirect()->route('cart')->with('success', 'Produk Berhasil Ditambah ke Cart');
      }

       //jika item tidak ada di cart, maka ditambah di cart dengan quantity 1
       $carts[$id] = [
            "id" => $id,
            "name" => $itemproduk->name,
            "quantity" => 1,
            "price" => $itemproduk->price,
            "subtotal" => $itemproduk->price * 1
    ];
    session()->put('cart', $carts);
    return redirect()->route('cart')->with('success', 'Produk Berhasil Ditambah ke Cart');

    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\CartItem  $cartItem
   * @return \Illuminate\Http\Response
   */
  public function show(CartItem $cartItem)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\CartItem  $cartItem
   * @return \Illuminate\Http\Response
   */
  public function edit(CartItem $cartItem)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\CartItem  $cartDetail
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $cartitem = CartItem::findOrFail($id);
    $param = $request->param;

    if ($param == 'tambah') {
      // update detail cart
      $qty = 1;
      $cartitem->updatedetail($cartitem, $qty, $cartitem->price);
      //update total cart
      $cartitem->cart->updatetotal($cartitem->cart, $cartitem->price);
      return back()->with('success', 'Item Berhasil diupdate');
    }
    if ($param == 'kurang') {
      //update detail cart
      $qty = 1;
      $cartitem->updatedetail($cartitem, '-' . $qty, $cartitem->price);
      //update total cart
      $cartitem->cart->updatetotal($cartitem->cart, '-' . $cartitem->price);
      return back()->with('success', 'Item berhasil diupdate');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\CartItem  $cartItem
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $cartitem = CartItem::findOrFail($id);
    //update total cart terlebih dahulu
    $cartitem->cart->updatetotal($cartitem->cart, '-' . $cartitem->subtotal);
    if ($cartitem->delete()) {
      return back()->with('success', 'Item Berhasil Dihapus');
    } else {
      return back()->with('error', 'Item Gagal Dihapus');
    }
  }

  public function update_quantity(Request $request, $id)
  {
    $param = $request->param;
    if($id)
    {
      if ($param == 'tambah') {
        $cart = session()->get('cart');
        $cart[$id]["quantity"]++;
        session()->put('cart', $cart);
        return back()->with('success', 'Item Berhasil diupdate');
      }
      if ($param == 'kurang'){
        $cart = session()->get('cart');
        $cart[$id]["quantity"]--;
        session()->put('cart', $cart);
        return back()->with('success', 'Item Berhasil diupdate');
      }
    }
  }

  public function remove($id)
  {
    if($id) {
      $cart = session()->get('cart');
        if(isset($cart[$id])) {
          unset($cart[$id]);
          session()->put('cart', $cart);
        }
      return back()->with('success', 'Item Berhasil Dihapus');
    }
  }
}
