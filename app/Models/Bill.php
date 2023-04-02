<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;

    //En este caso se aplica una lógica tipo 1 Producto = 1 Factura
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    
}
