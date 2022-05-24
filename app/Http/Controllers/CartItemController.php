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
        $this->validate($request, [
            'product_id' => 'required',
        ]);
        $itemuser = $request->user();
        $itemproduk = Product::findOrFail($request->product_id);
        // cek dulu apakah sudah ada shopping cart untuk user yang sedang login
        $cart = Cart::where('user_id', $itemuser->id)
            ->where('status_cart', 'cart')
            ->first();

        if (Auth::check()) {
          if ($cart) {
            $itemcart = $cart;
          } else {
            $no_invoice = Cart::where('user_id', $itemuser->id)->count();
            //mencari jumlah cart berdasarkan user untuk dijadikan no invoice
            $input['user_id'] = $itemuser->id;
            $input['no_invoice'] = 'INV ' . str_pad(($no_invoice + 1), '3', '0', STR_PAD_LEFT);
            $input['status_cart'] = 'cart';
            $input['status'] = 'belum';
            $itemcart = Cart::create($input);
          }

          //mengecek apakah sudah ada produk di cart
          $cekdetail = CartItem::where('cart_id', $itemcart->id)
            ->where('product_id', $itemproduk->id)
            ->first();

          $qty = 1;
          $harga = $itemproduk->price;
          $subtotal = $qty * $harga;

          if ($cekdetail) {
            //update detail di tabel cart item
            $cekdetail->updatedetail($cekdetail, $qty, $harga);
            //update subtotal dan total di tabel cart
            $cekdetail->cart->updatetotal($cekdetail->cart, $subtotal);
          } else {
            $inputan = $request->all();
            $inputan['cart_id'] = $itemcart->id;
            $inputan['product_id'] = $itemproduk->id;
            $inputan['quantity'] = $qty;
            $inputan['price'] = $harga;
            $inputan['subtotal'] = $harga * $qty;
            $inputan['active'] = 1;
            $cartitem = CartItem::create($inputan);
            //update subtotal dan total di tabel cart
            $cartitem->cart->updatetotal($cartitem->cart, $subtotal);
          }
          return redirect()->route('cart')->with('success', 'Produk Berhasil Ditambah ke Cart');
        }else{
          $cart = session()->get('cart');

          if (!$cart){

          }
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

        if ($param == 'tambah'){
            //update cart item
            $qty = 1;
            $cartitem->updatedetail($cartitem, $qty, $cartitem->harga);
            //update total cart
            $cartitem->cart->updatetotal($cartitem->cart, $cartitem->harga);
            return back()->with('success', 'Item Berhasil diupdate');
        }
        if ($param == 'kurang'){
            //update detail cart
            $qty = 1;
            $cartitem->updatedetail($cartitem, '-'.$qty, $cartitem->harga);
            //update total cart
            $cartitem->cart->updatetotal($cartitem->cart, '-'.$cartitem->harga);
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
        $cartitem->cart->updatetotal($cartitem->cart, '-'.$cartitem->subtotal);
        if ($cartitem->delete()){
            return back()->with('success', 'Item Berhasil Dihapus');
        } else {
            return back()->with('error', 'Item Gagal Dihapus');
        }
    }
}
