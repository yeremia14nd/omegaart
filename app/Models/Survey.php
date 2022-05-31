<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
