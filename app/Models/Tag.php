<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    //Pertenece a uno o más productos
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    //Pueden pertenecer a categorías:
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    
}
