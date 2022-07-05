<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'carts';

    protected $fillable = [
        'no_invoice',
        'user_id',
        'subtotal',
        'total',
        'status_cart',
        'status'
    ];

    protected $with = ['detail'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\CartItem', 'cart_id');
    }

    public function updatetotal($itemcart, $subtotal)
    {
        $this->attributes['subtotal'] = $itemcart->subtotal + $subtotal;
        $this->attributes['total'] = $itemcart->total + $subtotal;
        self::save();
    }

    public static function totalcart($id)
    {
        $data = DB::table('cart_items AS ci')
            ->selectRaw('COUNT(ci.id) as total')
            ->join('carts AS c', 'ci.cart_id', '=', 'c.id')
            ->join('users AS u', 'c.user_id', '=', 'u.id')
            ->where('u.id', $id)->where('c.status_cart', '=', 'cart')
            ->first();
        return $data;
    }

    public static function addToCart($id_user, $item_cart)
    {
        $cart = Cart::where('user_id', $id_user)->where('status_cart', 'cart')->first();

        if ($cart) {
            $itemcart = $cart;
        } else {
            $no_invoice = Cart::all()->count();

            // mencari jumlah cart berdasarkan user untuk dijadikan no invoice
            $input['user_id'] = $id_user;
            $input['no_invoice'] = 'INV ' . str_pad(($no_invoice + 1), '3', '0', STR_PAD_LEFT);
            $input['status_cart'] = 'cart';
            $input['status'] = 'belum';
            $itemcart = Cart::create($input);
        }

        $check_cart = is_array($item_cart);
        if ($check_cart) {
            // jika produk cart lebih dari 1
            foreach ($item_cart as $row) {
                $itemproduk = Product::findOrFail($row['id']);

                $cekdetail = CartItem::where('cart_id', $itemcart->id)
                    ->where('product_id', $itemproduk->id)
                    ->first();

                $qty = $row['quantity'];
                $harga = $itemproduk->price;
                $subtotal = $qty * $harga;
                if ($cekdetail) {
                    //update detail di tabel cart item
                    $cekdetail->updatedetail($cekdetail, $qty, $harga);

                    //update subtotal dan total di tabel cart
                    $cekdetail->cart->updatetotal($cekdetail->cart, $subtotal);
                } else {
                    $inputan = null;
                    $inputan['cart_id'] = $itemcart->id;
                    $inputan['product_id'] = $itemproduk->id;
                    $inputan['quantity'] = $qty;
                    $inputan['price'] = $harga;
                    $inputan['subtotal'] = $harga * $qty;
                    $inputan['active'] = 1;

                    $cartitem = CartItem::create($inputan);

                    // update subtotal dan total di tabel cart
                    $cartitem->cart->updatetotal($cartitem->cart, $subtotal);
                }
            }
        } else {
            // jika cuma 1
            $itemproduk = Product::findOrFail($item_cart);

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
                $inputan = null;
                $inputan['cart_id'] = $itemcart->id;
                $inputan['product_id'] = $itemproduk->id;
                $inputan['quantity'] = $qty;
                $inputan['price'] = $harga;
                $inputan['subtotal'] = $harga * $qty;
                $inputan['active'] = 1;

                $cartitem = CartItem::create($inputan);

                // update subtotal dan total di tabel cart
                $cartitem->cart->updatetotal($cartitem->cart, $subtotal);
            }
        }
    }
}
