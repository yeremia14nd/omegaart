<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Installment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function production()
    {
        return $this->belongsTo(Production::class);
    }

  public static function totalinstallments($id)
  {
    $data = DB::table('installments AS ins')
      ->selectRaw('COUNT(ins.id) as total')
      ->whereNull('ins.is_customer_confirm_date')->where('ins.user_id', $id)
      ->first();
    return $data;
  }
}
