<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['user', 'product'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
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
