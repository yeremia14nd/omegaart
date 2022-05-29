<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'cart_items';

    protected $fillable = [
        'product_id',
        'cart_id',
        'price',
        'quantity',
        'subtotal',
        'active'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart', 'cart_id');
    }

    // function untuk update qty, sama subtotal
    public function updatedetail($itemdetail, $qty, $harga) {
        $this->attributes['quantity'] = $itemdetail->quantity + $qty;
        $this->attributes['subtotal'] = $itemdetail->subtotal + ($qty * $harga);
        self::save();
    }

}
