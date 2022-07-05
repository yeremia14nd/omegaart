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

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    // protected $fillable = [
    //     'name',
    //     'username',
    //     'address',
    //     'phoneNumber',
    //     'imageAssets',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id'];
    protected $with = ['role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
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
