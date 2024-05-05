<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'item_name',
        'quantity',
        'total'
    ];

    /**
     * Get the user that owns the shopping cart.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the item associated with the shopping cart.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
