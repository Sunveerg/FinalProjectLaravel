<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingCart extends Model
{
    protected $table = 'items_cart';
    protected $fillable = [
        'user_id',
        'quantity',
        'name',
        'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
