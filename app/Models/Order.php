<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function survey()
    {
        return $this->hasMany(Survey::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function production()
    {
        return $this->hasOne(Production::class);
    }
}
