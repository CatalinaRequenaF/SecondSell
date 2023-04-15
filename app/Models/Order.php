<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    //Un pedido pertenece a un usuario 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Podria relacionarlo indirectamente con usuario pero prefiero poder editarlo en cada pedido
    //y que tanto address como paymentMethod sean independientes a user (user puede guardar muchas address y paymentMethods pero solo una estará activa y quizás no es ni la que ha decidido utilizar en el pedido)
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
    
    //Tiene un bill (se supone que está provisto por Laravel)
    public function bill(): HasOne
    {
        return $this->hasOne(Bill::class);
    }

    //Tiene varios (He creado 1-Product y 2-orderItems para más flexibilidad. Un producto puede tener muchas propiedades, cambiar de precio, estado... pero el orderItem tiene x precio final, y está pensado para definirse en una factura)
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }    
}
