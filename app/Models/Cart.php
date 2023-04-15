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

    //---------------------------RELACIONES-------------------------//
    //Un carrito pertenece a un usuario.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Desde un carrito se pueden hacer varios pedidos.
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    //Un carrito contiene uno o más productos.
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
