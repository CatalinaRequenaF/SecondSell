<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Follow extends Model
{
    use HasFactory;

    //El follow es realizado por un usuario concreto:
    public function user_following(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Y este usuario puede seguir a otro usuario...
    public function users_followed(): MorphToMany
    {
        return $this->morphByMany(User::class, 'followable');
    }

    //...un producto
    public function products_followed(): MorphToMany
    {
        return $this->morphByMany(Product::class, 'followable');
    }

    //... o una categoría entera
    public function categories_followed(): MorphToMany
    {
        return $this->morphByMany(Category::class, 'followable');
    }
}
