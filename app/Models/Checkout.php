<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Checkout extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  protected $table = 'checkouts';

  protected $fillable = [
    'user_id',
    'total',
    'payment_photo',
    // 'pay_until',
    'shipping_address',
    'status',
    'cart_id',
    'payment_type',
    'phone_number'
  ];

  protected $with = ['cart'];

  public function cart()
  {
    return $this->belongsTo('App\Models\Cart', 'cart_id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id');
  }

  public function updatecheckout($shipping, $payment, $payment_photo, $phone)
  {
    $this->attributes['shipping_address'] = $shipping;
    $this->attributes['payment_photo'] = $payment_photo;
    $this->attributes['payment_type'] = $payment;
    $this->attributes['phone_number'] = $phone;
    $this->attributes['status'] = 1;
    self::save();
  }

  public function update_status($status)
  {
    $this->attributes['status'] = $status;
    self::save();
  }

  public static function history($id)
  {
    $data = DB::table('checkouts AS c')
      ->selectRaw('ca.no_invoice, ca.total, c.payment_type, c.status')
      ->join('carts AS ca', 'c.cart_id', '=', 'ca.id')
      ->join('cart_items AS ci', 'ca.id', '=', 'ci.cart_id')
      ->join('users AS u', 'c.user_id', '=', 'u.id')
      ->where('u.id', $id)
      ->groupBy('ca.id')
      ->get();
    return $data;
  }
}
