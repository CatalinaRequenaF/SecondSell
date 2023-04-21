<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Negociation extends Model
{
    use HasFactory;

       //Los usuarios pueden negociar los precios de un producto, ya que se trata de una compra-venta entre los mismos.

       //En este caso, el usuario propone un precio:
       public function active_user(): BelongsTo
       {
           return $this->belongsTo(User::class);
       }

        //Y en este, recibe una oferta:
        public function passive_user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        //Hay que tener en cuenta que activo y pasivo no significan lo mismo que comprador o vendedor: el comprador puede hacer una oferta, y el vendedor otra, siendo así activos, pasivos y viceversa.

        //Por último, la negociación gira en torno a un producto
        public function product(): BelongsTo
        {
            return $this->belongsTo(Product::class);
        }
    }
