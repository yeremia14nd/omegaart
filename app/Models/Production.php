<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function installment()
    {
        return $this->hasOne(Installment::class);
    }
}
