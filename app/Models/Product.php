<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'state'
    ];

    //Pertenece a 
    public function user(): BelongsTo
{
    return $this->belongsTo(User::class, 'foreign_key');
}

   //Pertenece a 
   public function category(): BelongsTo
   {
       return $this->belongsTo(Category::class, 'foreign_key');
   }
   


    //Tiene muchos
    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }


}
