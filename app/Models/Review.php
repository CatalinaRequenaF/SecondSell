<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Review extends Model
{
    use HasFactory;


   //Pertenece a un usuario que escribe dicha reseña. El usuario vendedor estará relacionado indirectamente a través del producto.
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class);
   }

   //Pertenece a un producto en concreto, una vez se haya completado la transacción y se haya entregado.
   public function product(): BelongsTo
   {
       return $this->belongsTo(Product::class);
   }
       

    //Generalmente tendrá imágenes.
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }   

}
