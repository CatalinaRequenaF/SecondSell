<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Summary of Cart
 */
class Cart extends Model
{
    use HasFactory;


    //Pertenece a 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Tiene muchos
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    //Tiene muchos
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
