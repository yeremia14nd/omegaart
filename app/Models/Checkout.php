<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  protected $table = 'checkouts';

  protected $fillable = [
    'user_id',
    'total',
    'payment_photo',
    'pay_until',
    'shipping_address',
    'status',
    'cart_id',
    'payment_type'
  ];

  public function cart()
  {
    return $this->belongsTo('App\Models\Cart', 'cart_id');
  }

  public function updatecheckout($shipping, $payment, $payment_photo)
  {
    $this->attributes['shipping_address'] = $shipping;
    $this->attributes['payment_photo'] = $payment_photo;
    $this->attributes['payment_type'] = $payment;
    $this->attributes['status'] = 1;
    self::save();
  }
}
