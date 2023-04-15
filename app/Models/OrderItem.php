<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends Model
{
    use HasFactory;

    //Un OrderItem se genera a partir de un producto en concreto
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    //Los items pertenecen a un pedido
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }



}
