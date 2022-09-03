<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];
    protected $with = ['role'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function survey()
    {
        return $this->hasMany(Survey::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function hasRole($role): bool
    {
        if (is_string($role))
            $role = Role::where('name', $role)->first();

        return $this->role->contains($role);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
