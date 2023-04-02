<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    //----------Pertenece a ---------------
    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

   public function category(): BelongsTo
   {
       return $this->belongsTo(Category::class);
   }

   
   
   
    //Tiene muchos
    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
