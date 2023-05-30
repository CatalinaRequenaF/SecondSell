<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<integer, string>
     */
    protected $fillable = [
        'name',
        'description'
    ];

    //Una categoría contiene uno o más productos
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    //Una categoría puede tener seguidores.    
    public function followers(): MorphMany
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    //A una categoría se le pueden aplicar descuentos.
    public function discount(): MorphMany
    {
        return $this->morphMany(Discount::class, 'discountable');
    }
}