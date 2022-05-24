<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['category', 'productAvailability'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });

        // $query->when($filters['category'] ?? false, function ($query, $category) {
        //     return $query->whereHas('category', function ($query) use ($category) {
        //         $query->where('slug', $category);
        //     });
        // });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function survey()
    {
        return $this->hasMany(Survey::class);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItem()
    {
        return $this->hasMany(CartItem::class);
    }

    public function productAvailability()
    {
        return $this->belongsTo(ProductAvailability::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
