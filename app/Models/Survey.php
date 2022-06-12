<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['order'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function production()
    {
        return $this->hasOne(Production::class);
    }

    public static function totalsurvey($id)
    {
      $data = DB::table('orders AS o')
              ->selectRaw('COUNT(o.id) as total')
              ->join('surveys AS s', 's.order_id', '=', 'o.id')
              ->whereNotNull('s.assignTo')->whereNull('o.is_invoice_sent')->where('o.user_id', $id)
              ->first();
      return $data;
    }
}
