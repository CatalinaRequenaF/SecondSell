<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model
{
    use HasFactory;

    //Los productos pueden contener imágenes...
    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'imageable');
    }
 
    //...así como las reseñas.
    public function reviews(): MorphToMany
    {
        return $this->morphedByMany(Review::class, 'imageable');
    }

    //Los usuarios también pueden tener imágenes en su perfil (fotos de perfil antiguas, foto de perfil activa...)
    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'imageable');
    }
 
}
