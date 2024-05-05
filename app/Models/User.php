<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable=[
        'name',
        'password'
    ];

    public function shoppingCart(): HasOne
    {
        return $this->hasOne(ShoppingCart::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
