<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Review extends Model
{
    use HasFactory;


   //Pertenece a (Quien la escribe, el vendedor está relacionado indirectamente con el producto)
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class);
   }

   public function product(): BelongsTo
   {
       return $this->belongsTo(Product::class);
   }
       

    //----Polimorfica (tiene imágenes)
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }   

}
