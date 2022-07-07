<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

  public static function totalinvoice($id)
  {
    $data = DB::table('invoices AS iv')
      ->selectRaw('COUNT(iv.id) as total')
      ->join('orders AS o', 'o.id', '=', 'iv.order_id')
      ->where('iv.is_validated', 1)->whereNull('o.is_paid_invoiced')->where('o.user_id', $id)
      ->first();
    return $data;
  }
}
