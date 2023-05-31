<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'state'
    ];

    //-----------------------RELACIONES--------------------
    //El producto está puesto en venta por un usuario
    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

    //Pertenece a una categoría
   public function category(): BelongsTo
   {
       return $this->belongsTo(Category::class);
   }  

   //Seller id
   public function seller_id(): BelongsTo
   {
       return $this->belongsTo(User::class);
   }  
   
    //Puede tener etiquetas para facilitar la búsqueda
    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class);
    }

    //Puede tener imágenes, followers y descuentos
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function followers(): MorphMany
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    public function discount(): MorphMany
    {
        return $this->morphMany(Discount::class, 'discountable');
    }

}
